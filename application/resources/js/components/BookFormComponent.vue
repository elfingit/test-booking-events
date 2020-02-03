<template>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Book for - {{ place.price }}</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="Enter company name" v-model="formData.company_name" id="company_name" type="text" class="validate">
                    <label for="company_name">Company name</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Enter person name" v-model="formData.contact_name" id="contact_name" type="text" class="validate">
                    <label for="contact_name">Contact name</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Enter email" v-model="formData.email" id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Enter phone" v-model="formData.phone" id="phone" type="tel" class="validate">
                    <label for="phone">Phone</label>
                </div>
                <div class="input-field col s6">
                    <textarea placeholder="Enter description" v-model="formData.description" id="description" class="materialize-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <span>Company Logo</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="waves-effect waves-green btn-flat">Book</button>
            <button class="modal-close waves-effect waves-green btn-flat" @click="cancelForm">Cancel</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookFormComponent",

        data() {
            return {
                place: {},
                formData: {
                    company_name: '',
                    contact_name: '',
                    email: '',
                    phone: '',
                    description: ''
                },
                logoFile: null
            }
        },

        mounted() {
            window.M.AutoInit()
        },

        methods: {
            show: function (place) {

                this.place = place
                window.M.updateTextFields()
                window.M.Modal
                    .getInstance(this.$el)
                    .open()
            },

            cancelForm: function(event) {
                event.preventDefault();

                this.formData = {
                    company_name: '',
                    contact_name: '',
                    email: '',
                    phone: '',
                    description: ''
                }
            }
        }
    }
</script>

<style scoped>

</style>
