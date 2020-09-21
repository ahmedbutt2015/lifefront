<template>
    <section>
        <!--Hero End -->
        <section class="all-starups-area">

            <div class="container">


                <div class="row">
                    <div class="col">
                        <!--      Wizard container        -->
                        <div class="wizard-container">
                            <div class="card wizard-card" data-color="green" id="wizardProfile">

                                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

                                <div class="wizard-header">
                                    <h3 class="wizard-title">Build Your Character</h3>
                                    <h5>Make Your Selection</h5>
                                </div>
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#city" data-toggle="tab" id="tab1" :data-checked="checked.city">City</a></li>
                                        <li><a href="#gender" data-toggle="tab" id="tab2" :data-checked="checked.gender">Gender</a></li>
                                        <li><a href="#skin" data-toggle="tab" id="tab3" :data-checked="checked.skin">Skin</a></li>
                                        <li><a href="#hair" data-toggle="tab" id="tab4" :data-checked="checked.hair">Hair</a></li>
                                        <li><a href="#body" data-toggle="tab" id="tab5" :data-checked="checked.body">Body</a></li>
                                        <li><a href="#family" data-toggle="tab" id="tab6" :data-checked="checked.family">Family</a></li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="city">

                                        <div class="row">
                                            <div class="col" v-for="city in cities">
                                                <div class="choice" data-toggle="wizard-radio" @click="checked.city = city.slug">
                                                    <input type="radio" name="language" :value="city.slug">
                                                    <div class="icon"></div>
                                                    <h6>{{city.title}}</h6>
                                                    <p>{{city.language_name}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="gender">
                                        <div class="row">

                                            <div class="col" v-for="g in genders">
                                                <div class="choice" data-toggle="wizard-radio" @click="checked.gender = g.slug">
                                                    <input type="radio" name="gender" :value="g.slug" class="required">
                                                    <div class="icon"></div>
                                                    <h6>{{g.title}}</h6>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="skin">

                                        <div class="row">
                                            <div class="col" v-for="skin in skins">
                                                <div class="choice" data-toggle="wizard-radio" @click="checked.skin = skin.value">
                                                    <input type="radio" name="skin" :value="skin.value" class="required">
                                                    <div class="icon"></div>
                                                    <h6>{{skin.color}}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="hair">

                                        <div class="row">
                                            <div class="col" v-for="h in hair">
                                                <div class="choice" data-toggle="wizard-radio" @click="checked.hair = h.value">
                                                    <input type="radio" name="hair" :value="h.value" class="required">
                                                    <div class="icon"></div>
                                                    <h6>{{h.color}}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="body">

                                        <div class="row">
                                            <div class="col" v-for="body in bodies">
                                                <div class="choice" data-toggle="wizard-radio" @click="checked.body = body.value">
                                                    <input type="radio" name="body" :value="body.value" class="required">
                                                    <div class="icon"></div>
                                                    <h6>{{body.name}}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="family">
                                        <div class="container-fluid">

                                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">Create New</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="existing-tab" data-toggle="tab" href="#existing" role="tab" aria-controls="existing" aria-selected="true">Use Existing</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="new" role="tabpanel">
                                                    <div class="mt-10">
                                                        <input type="text" v-model="checked.first_name" placeholder="First Name" @keypress="alphabetsOnly($event)" required class="single-input">
                                                    </div>
                                                    <div class="mt-10">
                                                        <input type="text" v-model="checked.last_name" placeholder="Last Name" @keypress="alphabetsOnly($event)" required class="single-input">
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="existing" role="tabpanel">
                                                    <div class="mt-10">
                                                        <p class="text-muted"><b>Note:</b> Only Skin, Hair, Body will update.</p>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating is-empty">
                                                                <label class="control-label">Select Character</label>
                                                                <select class="form-control" v-model="checked.character_id">
                                                                    <option disabled selected value="0"></option>
                                                                    <option :value="character.id" v-for="character in characters">{{ character.first_name }} {{character.last_name}}</option>
                                                                </select>
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer">
                                    <div class="row">
                                        <div class="col text-left">
                                            <input type='button' class='btn btn-previous btn-fill btn-info btn-wd' name='previous' value='Previous'/>
                                        </div>
                                        <div class="col text-right">
                                            <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next'/>
                                            <input type='button' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Finish' @click="saveCharacter"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- wizard container -->
                    </div>
                </div><!-- end row -->

            </div>

        </section>
    </section>
</template>

<script>
    export default {
        name: "CharacterCreation",
        data: () => ({
            cities: [],
            hair: [],
            skins: [],
            bodies: [],
            genders: [],
            characters: [],

            checked: {
                city: '0',
                gender: '0',
                skin: '0',
                hair: '0',
                body: '0',
                family: '0',
                first_name: '',
                last_name: '',
                character_id: 0, 
            },
        }),
        async mounted() {
            const {data} = await axios.post('/ajax/getCharacterSettings');
            this.cities = data.cities;
            this.hair = data.hair;
            this.skins = data.skins;
            this.bodies = data.bodies;
            this.genders = data.genders;
            this.characters = data.characters;
            setTimeout(() => {
                this.init()
            }, 2000)
        },

        methods: {
            init() {

                $.material.init();

                /*  Activate the tooltips      */
                $('[rel="tooltip"]').tooltip();

                // Wizard Initialization
                $('.wizard-card').bootstrapWizard({
                    'tabClass': 'nav nav-pills',
                    'nextSelector': '.btn-next',
                    'previousSelector': '.btn-previous',

                    onNext: function (tab, navigation, index) {
                        let value = $("#tab" + index).attr('data-checked');
                        console.log(value)
                        if (value == 0) {
                            return false;
                        }
                        // return false;
                    },

                    onInit: function (tab, navigation, index) {
                        //check number of tabs and fill the entire row
                        var $total = navigation.find('li').length;
                        var $wizard = navigation.closest('.wizard-card');

                        let $first_li = navigation.find('li:first-child a').html();
                        let $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                        $('.wizard-card .wizard-navigation').append($moving_div);

                        refreshAnimation($wizard, index);

                        $('.moving-tab').css('transition', 'transform 3s');
                    },

                    onTabClick: function (tab, navigation, index) {
                        return false;
                    },

                    onTabShow: function (tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;

                        var $wizard = navigation.closest('.wizard-card');

                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $($wizard).find('.btn-next').hide();
                            $($wizard).find('.btn-finish').show();
                        } else {
                            $($wizard).find('.btn-next').show();
                            $($wizard).find('.btn-finish').hide();
                        }

                        let button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                        setTimeout(function () {
                            $('.moving-tab').text(button_text);
                        }, 150);

                        var checkbox = $('.footer-checkbox');

                        if (!index == 0) {
                            $(checkbox).css({
                                'opacity': '0',
                                'visibility': 'hidden',
                                'position': 'absolute'
                            });
                        } else {
                            $(checkbox).css({
                                'opacity': '1',
                                'visibility': 'visible'
                            });
                        }

                        refreshAnimation($wizard, index);
                    }
                });


                // Prepare the preview for profile picture
                $("#wizard-picture").change(function () {
                    readURL(this);
                });

                $('[data-toggle="wizard-radio"]').click(function () {
                    let wizard = $(this).closest('.wizard-card');
                    wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
                    $(this).addClass('active');
                    $(wizard).find('[type="radio"]').removeAttr('checked');
                    $(this).find('[type="radio"]').attr('checked', 'true');
                });

                $('[data-toggle="wizard-checkbox"]').click(function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $(this).find('[type="checkbox"]').removeAttr('checked');
                    } else {
                        $(this).addClass('active');
                        $(this).find('[type="checkbox"]').attr('checked', 'true');
                    }
                });

                $('.set-full-height').css('height', 'auto');

            },
            saveCharacter() {
                if ((this.checked.first_name == '' || this.checked.last_name == '') && this.checked.character_id == 0) {
                    alert("Fill up Character Name OR Select Existing");
                } else {
                    console.log("this.checked",this.checked);
                    axios.post('/ajax/saveCharacter', {data: this.checked})
                        .then(res => {
                            let data = res.data
                            if (data.status === 'ok') {
                                window.location = data.link
                            }
                            alert(data.msg)

                        })
                        .catch(error => {
                            console.log(error.response)
                        })
                }


            },
            alphabetsOnly(evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)) {
                    return true;
                }
                evt.preventDefault();
            },
        }
    }


</script>

<style scoped>
    .nav-tabs .nav-link.active {
        color:            #495057;
        background-color: #FFFFFF;
        border-color:     #DEE2E6 #DEE2E6 #FFFFFF;
    }

    .nav-link {
        color: #635C5C;
    }
</style>
