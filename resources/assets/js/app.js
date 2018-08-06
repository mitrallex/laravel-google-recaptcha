
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',

    data: {
        form: {
            name: '',
            email: '',
            message: ''
        },

        errors: {}
    },

    methods: {
        leaveFeedback: function() {
            let form_data = new FormData();
            form_data.append('name', this.form.name);
            form_data.append('email', this.form.email);
            form_data.append('message', this.form.message);
            form_data.append('g-recaptcha-response', $("#g-recaptcha-response").val());

            axios.post('/feedback/create', form_data)
                .then(response => {
                    this.$swal({
                        title: 'Message successfully send!',
                        type: 'success'
                    });

                    this.clearForm();
                    this.resetRecaptcha();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;

                    let errors_list = '';

                    for (let field in this.errors) {
                        errors_list += '<li class="list-group-item list-group-item-danger">' + this.errors[field][0] + '</li>';
                    }

                    this.$swal({
                        title: error.response.data.message,
                        type: 'error',
                        html: '<ul class="list-group list-group-flush">' + errors_list + '</ul>'
                    });
                });

        },

        clearForm: function() {
            this.form.name = '';
            this.form.email = '';
            this.form.message = '';
        },

        resetRecaptcha: function() {
            grecaptcha.reset();
        },

        anyErrors: function() {
            return Object.keys(this.errors).length > 0;
        },

        hasError: function(field) {
            return this.errors.hasOwnProperty(field);
        },

        getError: function(field){
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }
    }
});
