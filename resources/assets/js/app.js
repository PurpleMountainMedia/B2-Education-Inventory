require('./bootstrap')
import 'babel-polyfill'
import Vue from 'vue'
import Element from 'element-ui'
import locale from 'element-ui/lib/locale/lang/en'
import en from './lang/en.json'
import moment from 'moment'

Vue.use(Element, {locale, size: 'small'})

Vue.config.productionTip = false

// Mixin
Vue.mixin({
    mounted () {
        if (process.env.NODE_ENV === 'development') {
            // console.log(`${this.$options.name}.vue mounted!`);
        }
    },

    computed: {
        eiDefaults() {
          return window.eiDefaults;
        },

        eiSchool() {
          return window.eiSchool;
        },

        eiDateFormat() {
          return 'dd/MM/yyyy';
        },

        serverDateFormat() {
          return 'dd/MM/yyyy';
        },
    },

    methods: {
        __(key) {
            return en[key] ? en[key] : key;
        },

        dateTime (date = '', format = '') {
          return moment(date, format)
        },

        ucFirst(str) {
            var lower = String(str)
            lower = lower.toLowerCase()
            return lower.replace(/(^| )(\w)/g, function(x) {
                return x.toUpperCase()
            });
        }
    }
});

const app = new Vue({
    el: '#app',

    name: 'EducationInventoryApp',

    components: {
        MainMenu: () => import(/* webpackChunkName: "main-menu" */'components/MainMenu'),
        AddNewModal: () => import(/* webpackChunkName: "add-new-modal" */'components/AddNewModal'),
        ItemsCreateTable: () => import(/* webpackChunkName: "items-create-table" */'components/ItemsCreateTable'),
        DataTable: () => import(/* webpackChunkName: "data-table" */'components/DataTable'),
        SchoolSelecter: () => import(/* webpackChunkName: "school-selecter" */'components/SchoolSelecter'),
        ListBuildings: () => import(/* webpackChunkName: "list-buildings" */'components/buildings/ListBuildings'),
        ListRooms: () => import(/* webpackChunkName: "list-rooms" */'components/rooms/ListRooms'),
        ListItems: () => import(/* webpackChunkName: "list-items" */'components/items/ListItems'),
        BuildingEditForm: () => import(/* webpackChunkName: "building-edit-form" */'components/buildings/BuildingEditForm'),
        RoomEditForm: () => import(/* webpackChunkName: "room-edit-form" */'components/rooms/RoomEditForm'),
    },

    mounted () {

    }
})
