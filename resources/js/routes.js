import Vue from 'vue';
import VueRouter from 'vue-router';

import page_404 from "./pages/page_404";
import Register from "./pages/Register";
import Login from "./pages/Login";
import Home from "./pages/Home";
import CharacterCreation from "./pages/CharacterCreation";
import City from "./pages/City";
import Profile from "./pages/Profile";
import DailyLife from "./pages/DailyLife";
import MyGift from "./pages/MyGift";
import MyHome from "./pages/MyHome";
import MyFamily from "./pages/MyFamily";
import EmployeeCenter from "./pages/EmployeeCenter";
import Advertiser from "./pages/jobs/Advertiser";
import Farmer from "./pages/jobs/Farmer";
import FactoryManager from "./pages/jobs/FactoryManager";
import CityList from "./pages/CityList";
import Messages from "./pages/Messages";
import Restaurants from "./pages/jobs/Restaurants";
import Dustman from "./pages/jobs/Dustman";
import Delivery from "./pages/jobs/Delivery";
import Journalist from "./pages/jobs/Journalist";
import ShopKeeper from "./pages/jobs/ShopKeeper";
import SportCoach from "./pages/jobs/SportCoach";
import GeneralPractitioner from "./pages/jobs/GeneralPractitioner";
import Pharmacist from "./pages/jobs/Pharmacist";
import PhoneSeller from "./pages/jobs/PhoneSeller";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/account',
            name: 'home',
            component: Home
        }, {
            path: '/city',
            name: 'cities',
            component: CityList
        }, {
            path: '/city/:name/',
            name: 'city',
            component: City
        }, {
            path: '/city/:name/employee_center',
            name: 'employee_center',
            component: EmployeeCenter
        }, {
            path: '/city/:name/messages/',
            name: 'messages',
            component: Messages,
        }, {
            path: '/city/:name/history',
            name: 'history',
            component: DailyLife
        }, {
            path: '/city/:name/gift',
            name: 'mygift',
            component: MyGift
        }, {
            path: '/city/:name/advertiser/:id',
            name: 'advertiser',
            component: Advertiser
        }
        , {
            path: '/city/:name/farmer/:id',
            name: 'farmer',
            component: Farmer
        }, {
            path: '/city/:name/farmer/:id/visitor/:farmer',
            name: 'farmer_visitor',
            component: Farmer
        },
         {
            path: '/city/:name/factory/:id',
            name: 'factory',
            component: FactoryManager
        }, {
            path: '/city/:name/factory/:id/visitor/:factory',
            name: 'factory_visitor',
            component: FactoryManager
        }, {
            path: '/city/:name/delivery/:id',
            name: 'delivery',
            component: Delivery
        }, {
            path: '/city/:name/delivery/:id/visitor/:character',
            name: 'delivery_visitor',
            component: Delivery
        }, {
            path: '/city/:name/journalist/:id',
            name: 'journalist',
            component: Journalist
        }, {
            path: '/city/:name/journalist/:id/visitor/:character',
            name: 'journalist_visitor',
            component: Journalist
        }, {
            path: '/city/:name/restaurant/:id',
            name: 'restaurant',
            component: Restaurants
        }, {
            path: '/city/:name/restaurant/:id/visitor/:keeper',
            name: 'restaurant_visitor',
            component: Restaurants
        }, {
            path: '/city/:name/shopkeeper/:id',
            name: 'shopkeeper',
            component: ShopKeeper
        }, {
            path: '/city/:name/shopkeeper/:id/visitor/:keeper',
            name: 'shopkeeper_visitor',
            component: ShopKeeper
        },{
            path: '/city/:name/dustman/:id',
            name: 'dustman',
            component: Dustman
        }, {
            path: '/city/:name/dustman/:id/visitor/:keeper',
            name: 'dustman_visitor',
            component: Dustman
        },{
            path: '/city/:name/phoneseller/:id',
            name: 'phoneseller',
            component: PhoneSeller
        }, {
            path: '/city/:name/phoneseller/:id/visitor/:keeper',
            name: 'phoneseller_visitor',
            component: PhoneSeller
        }, {
            path: '/city/:name/sportcoach/:id',
            name: 'sportcoach',
            component: SportCoach
        }, {
            path: '/city/:name/sportcoach/:id/visitor/:owner',
            name: 'sportcoach_visitor',
            component: SportCoach
        }, {
            path: '/city/:name/doctor/:id',
            name: 'generalpractitioner',
            component: GeneralPractitioner
        }, {
            path: '/city/:name/doctor/:id/visitor/:owner',
            name: 'generalpractitioner_visitor',
            component: GeneralPractitioner
        }, {
            path: '/city/:name/pharmacist/:id',
            name: 'pharmacist',
            component: Pharmacist
        }, {
            path: '/city/:name/pharmacist/:id/visitor/:owner',
            name: 'pharmacist_visitor',
            component: Pharmacist
        }, {
            path: '/city/:name/myfamily',
            name: 'myfamily',
            component: MyFamily
        }, {
            path: '/city/:name/:address',
            name: 'profile',
            component: Profile
        }, {
            path: '/create-character',
            name: 'characterCreation',
            component: CharacterCreation
        }, {
            path: '/myhome',
            name: 'myhome',
            component: MyHome
        }, {
            path: '/login',
            name: 'login',
            meta: {layout: '@/layouts/Auth'},
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            meta: {layout: '@/layouts/Auth'},
            component: Register
        },
        {
            path: "*",
            component: page_404
        }
    ]
})

export default router;
