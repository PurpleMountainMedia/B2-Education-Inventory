require('./bootstrap')
import Vue from 'vue'
import Element from 'element-ui'
import locale from 'element-ui/lib/locale/lang/en'
import en from './lang/en.json'

Vue.use(Element, {locale, size: 'small'})

Vue.config.productionTip = false

// Mixin
Vue.mixin({
    mounted () {
        if (process.env.NODE_ENV === 'development') {
            console.log(`${this.$options.name}.vue mounted!`);
        }
    },

    computed: {
        eiDefaults()
        {
            return window.eiDefaults;
        }
    },

    methods: {
        __(key)
        {
            return en[key] ? en[key] : key;
        },

        ucFirst(str)
        {
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
    },
})
