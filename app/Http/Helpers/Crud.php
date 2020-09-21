<?php
namespace App\Http\Helpers;

trait Crud
{

    public static function addUpdate (array $input, int $id = 0) {
        $self = new static;
        if ( !property_exists($self, 'insert')) {
            return false;
        }
        $fields = $self->insert;
        $multi = property_exists($self, 'multi_to_string') ? $self->multi_to_string : [];
        $glue = property_exists($self, 'glue') ? $self->glue : ',';
        $images = property_exists($self, 'uploads') ? $self->uploads : [];
        $checks = property_exists($self, 'checks') ? $self->checks : [];
        if ($id == 0) {
            $create = [];

            foreach ($fields as $field) {
                if (isset($input[$field]))
                    $create[$field] = $input[$field];
            }
            if (count($multi)) {
                foreach ($multi as $field) {
                    if (isset($input[$field]) && is_array($input[$field]))
                        $create[$field] = implode($glue, $input[$field]);
                }
            }

            if (count($checks)) {
                foreach ($checks as $field) {
                    $create[$field] = isset($input[$field]) ? 1 : 0;
                }
            }
            if (count($images)) {
                foreach ($images as $field) {
                    $name = $field['name'];
                    $path = $field['path'];
                    if (request()->hasFile($name))
                        $create[$name] = self::UploadFile($name, $path);
                }
            }


            return self::create($create);
        } else {
            if (property_exists($self, 'update')) {
                $fields = $self->update;
            }

            $update = [];

            foreach ($fields as $field) {
                if (isset($input[$field]))
                    $update[$field] = $input[$field];
            }
            if (count($multi)) {
                foreach ($multi as $field) {
                    if (isset($input[$field]) && is_array($input[$field]))
                        $update[$field] = implode($glue, $input[$field]);
                }
            }
            if (count($images)) {
                foreach ($images as $field) {
                    $name = $field['name'];
                    $path = $field['path'];

                    if (request()->hasFile($name)) {
                        if ($input["old_" . $name] && file_exists($input["old_" . $name])) {
                            unlink($input["old_" . $name]);
                        }
                        $update[$name] = self::UploadFile($name, $path);
                    }
                }
            }

            return self::where($self->primaryKey, $id)->update($update);
        }
    }

    private static function UploadFile ($field_name, $storagePath) {
        $imageName = time() . '.' . request()->{$field_name}->getClientOriginalExtension();
        request()->{$field_name}->move(public_path($storagePath), $imageName);
        return $storagePath . '/' . $imageName;
    }


}
