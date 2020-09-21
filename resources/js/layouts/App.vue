<template>
    <section>
                    <Loading v-if="isLoading"></Loading>
        <header>
            <!-- Header Start -->
            <div class="header-area header-transparent">
                <div class="main-header">
                    <div class="header-bottom  header-sticky">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <!-- Logo -->
                                <div class="col-xl-2 col-lg-1 col-md-1">
                                    <div class="logo">
                                        <a href="/"><img src="/assets/img/logo/logo.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-11 col-md-11">
                                    <!-- Main-menu -->

                                    <div class="main-menu f-right d-none d-lg-block">

                                        <div class="dropdown text-right">
                                            <div class="text-white">
                                                {{dateTime}}
                                            </div>
                                            <!--                                            <button class="circle " type="button" >-->
                                            <img :src='profileImg' :alt="user.username" id="profile-img"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                                            <!--                                            </button>-->
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profile-img">
                                                <router-link class="dropdown-item" to="/account">Account</router-link>
                                                <a class="dropdown-item" href="/logout">Logout</a>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <!-- Mobile Menu -->
                                <div class="col-12">
                                    <div class="mobile_menu d-block d-lg-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->
        </header>


        <main>
            <div class="slider-area slider-bg ">
                <div class="single-slider d-flex align-items-center slider-height2 ">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap text-center pt-50">
                                    <h2 class="page-title" v-html="routeName"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider Shape -->
                <div class="slider-shape d-none d-lg-block">
                    <img class="slider-shape1" src="/assets/img/hero/top-left-shape.png" alt="">
                    <img class="slider-shape2" src="/assets/img/hero/right-top-shape.png" alt="">
                    <img class="slider-shape3" src="/assets/img/hero/left-botom-shape.png" alt="">
                </div>
            </div>


            <div class="icon-menu slider-bg" :class="hide" v-if="has_character">
                <ul>
                    <li>
                        <router-link :to="character_link" active-class="active" title="Profile"><i class="fa fa-laptop"></i></router-link>
                    </li>
                    <li>
                        <router-link :to="daily_life" active-class="active" title="Daily Life"><i class="fa fa-book"></i></router-link>
                    </li>
                    <li>
                        <router-link to="/myhome" active-class="active" title="My Home"><i class="fa fa-home"></i></router-link>
                    </li>
                    <li>
                        <router-link :to="my_family" active-class="active" title="My Family"><i class="fa fa-users"></i></router-link>
                    </li>
                    <li>
                        <router-link :to="city_link" active-class="active" title="The City"><i class="fa fa-building"></i></router-link>
                    </li>
                    <li>
                        <router-link :to="job_link" active-class="active" title="Jobs"><i class="fa fa-briefcase"></i></router-link>
                    </li>
                    <li>
                        <router-link :to="messages" active-class="active"><i class="fa fa-envelope-open"></i></router-link>
                    </li>
                    <!--                    <li>-->
                    <!--                        <router-link to="/"><i class="far fa-theater-masks"></i></router-link>-->
                    <!--                    </li>-->
                    <li>
                        <router-link :to="my_gift" active-class="active" title="My Gift"><i class="fa fa-gift"></i></router-link>
                    </li>
                </ul>
            </div>
            <div class="container">

                <router-view></router-view>
            </div>
        </main>
        <footer>
            <!-- Footer Start-->
            <div class="footer-area">
                <div class="container">
                    <div class="footer-top footer-padding">

                    </div>
                    <div class="footer-bottom">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-xl-9 col-lg-9 ">
                                <div class="footer-copy-right">

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <!-- Footer Social -->
                                <div class="footer-social f-right">
                                    <a href="https://www.facebook.com/MogalysOnline"><i class="fab fa-facebook-f"></i></a>
                                    <!--                                    <a href="https://discord.gg/fKmW7k"><i class="fab fa-discord"></i></a>-->
                                    <a href="https://discord.com/invite/rp7QuKu"><i class="fab fa-discord"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fas fa-globe"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </footer>
    </section>
</template>

<script>
import Loading from "../layouts/Loading";
    export default {
                    components: {
                Loading
               },
        props: {},
        data: () => ({
            dateTime: '',
            refCount: 0,
    isLoading: false,
        }),
        async mounted() {
            let self = this
            window.setInterval(function () {
                let date = new Date();
                self.dateTime = date.toUTCString()
            },500);

        },
        created() {
  axios.interceptors.request.use((config) => {
    //  trigger 'loading=true' event here
    this.isLoading = true;

    return config;
  }, (error) => {
    // trigger 'loading=false' event here
    this.isLoading = false;
    return Promise.reject(error);
  });

  axios.interceptors.response.use((response) => {
    // trigger 'loading=false' event here
    this.isLoading = false;
    return response;
  }, (error) => {
    // trigger 'loading=false' event here
    this.isLoading = false;
    return Promise.reject(error);
  });
},
        computed: {
            hide() {
                if (this.$route.path == '/account') {
                    return 'd-none';
                }
                return '';
            },
            has_character() {
                if (this.user.character) {
                    return true;
                }
                return false;
            },
            user() {
                return this.$root.user
            },
            profileImg() {
                if (user.pic) {
                    return "/" +user.pic;
                }
                return '/images/user-default.png';
            },
            character_link() {
                if (this.has_character) {
                    let ch = this.user.character
                    return "/city/" + ch.prefix + "/" + ch.address;
                }
                return "";
            },
            daily_life() {
                if (this.has_character) {
                    let ch = this.user.character;
                    return "/city/" + ch.prefix + "/history";
                }
                return "";
            },
                 my_gift() {
                if (this.has_character) {
                    let ch = this.user.character;
                    return "/city/" + ch.prefix + "/gift";
                }
                return "";
            },
            job_link() {
                if (this.has_character) {
                    let ch = this.user.character;
                    let job_name = '';
                    if (ch.job_name) {
                        let from_admin = ch.job_name.toLowerCase();
                        if (from_admin.includes('farmer')) {
                            job_name = 'farmer'
                        }
                        if (from_admin.includes('factory')) {
                            job_name = 'factory'
                        }
                        if (from_admin.includes('restaurant')) {
                            job_name = 'restaurant'
                        }
                        if (from_admin.includes('delivery')) {
                            job_name = 'delivery'
                        }
                        if (from_admin.includes('journalist')) {
                            job_name = 'journalist'
                        }
                        if (from_admin.includes('shopkeeper')) {
                            job_name = 'shopkeeper'
                        }
                        if (from_admin.includes('practitioner')) {
                            job_name = 'doctor'
                        }
                        if (from_admin.includes('pharmacist')) {
                            job_name = 'pharmacist'
                        }
                        if (from_admin.includes('sport')) {
                            job_name = 'sportcoach'
                        }
                        if (from_admin.includes('dustman')) {
                            job_name = 'dustman'
                        }
                        if (from_admin.includes('phone')) {
                            job_name = 'phoneseller'
                        }
                        return "/city/" + ch.prefix + "/" + job_name + "/" + ch.job;
                    }
                }
                return '';
            },
            messages() {
                if (this.has_character) {
                    let ch = this.user.character;
                    return "/city/" + ch.prefix + "/messages";
                }
                return "";
            },
            my_family() {
                if (this.has_character) {
                    let ch = this.user.character;
                    return "/city/" + ch.prefix + "/myfamily";
                }
                return "";
            },
            city_link() {
                return "/city/" + this.user.character.prefix
            },
            routeName() {
                let path = this.$route.path;

                if (path == '/account')
                    return 'Account Page';
                else if (path == '/myhome')
                    return 'My Home';
                else if (path == '/jobs')
                    return 'Jobs';
                else if (path == '/create-character')
                    return 'Character Creation Page';
                else if (path == '/city')
                    return 'Cities';
                else if (path.includes('city')) {
                    if (path.includes('history'))
                        return 'My Daily Life';
                    if (path.includes('messages'))
                        return 'Messages';
                    if (path.includes('myfamily'))
                        return 'My Family';
                    if (path.includes('restaurant'))
                        return 'Restaurant Keeper';
                    if (path.includes('delivery'))
                        return 'Delivery Man';
                    if (path.includes('advertiser'))
                        return 'Advertiser Job';
                    if (path.includes('farmer'))
                        return 'Farmer Job';
                    if (path.includes('factory'))
                        return 'Factory Manager Job';
                    if (path.includes('shop'))
                        return 'ShopKeeper Job';
                    if (path.includes('dustman'))
                        return 'Dustman';
                    if (path.includes('dustmanmanager'))
                        return 'Dustmanmanager';
                    if (path.includes('pharmacist'))
                        return 'Pharmacist Job';
                    if (path.includes('phoneseller'))
                        return 'Phone Seller';
                    if (path.includes('sportcoach'))
                        return 'Sport Coach Job';
                    if (path.includes('doctor'))
                        return 'General Practitioner Job';
                    if (path.includes('journalist'))
                        return 'Journalist Job';
                    return 'Profile';
                } else
                    return '404'

            },
        },
        methods: {
  setLoading(isLoading) {
    if (isLoading) {
      this.refCount++;
      this.isLoading = true;
    } else if (this.refCount > 0) {
      this.refCount--;
      this.isLoading = (this.refCount > 0);
    }
  }
}
    }
    

</script>
