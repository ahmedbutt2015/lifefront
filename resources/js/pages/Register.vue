<template>
    <form id="register-from" class="form" method="post">

        <div @click="error_list=null" class="alert alert-danger" v-if="error_list != null">
            <p v-for="error in error_list" v-html="error[0]"></p>
        </div>
        <h3>New Account?</h3>
        <div class="form-holder">
            <span class="lnr lnr-user"></span>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-holder">
            <span class="lnr lnr-envelope"></span>
            <input type="text" name="email" class="form-control" placeholder="Mail" required>
        </div>
        <div class="form-holder">
            <span class="lnr lnr-lock"></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-holder">
            <span class="lnr lnr-lock"></span>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        </div>
        <div class="g-recaptcha" data-sitekey="6Lfp5v8UAAAAAP6-K0CwABnV8SWwyMtJO5n3w7la"></div>

        <button @click="register"
            type="button"
            data-callback="onSubmit">
            Register
        </button>
        <!--        <button type="button" @click="register">Register</button>-->
        <br>
        <div><a href="/login/facebook" class=""><i class="fa fa-facebook"></i> Login with Facebook</a></div>
        <div><a href="/login/google"><i></i> Login with Google</a></div>

        <br>
        <router-link style="color:#222222" to="/login">Back to log in page</router-link>
    </form>
</template>

<script>
    export default {
        data: () => ({
            error_list: null
        }),
        methods: {
            register() {
                let form = $('#register-from');
                let data = form.serialize();
                let url = '';
                let obg = this
                axios.post(url, data)
                    .then(function (response) {
                        console.log("aaaaa");
                        console.log("res",response);
                        alert(response.data.msg)
                        form.resetForm();
                        window.location = '/';
                    })
                    .catch(function (error) {
                        console.log("dddd");
                        let data = error.response.data
                        console.log(data)
                        obg.error_list = data.errors
                        // alert(data.message);
                    });

            }
        }
    }


</script>
