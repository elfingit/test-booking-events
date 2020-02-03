<template>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Book for - {{ place.price }}</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="Enter company name"
                           v-model="formData.company_name"
                           :disabled="this.lockForm"
                           id="company_name"
                           type="text"
                           class="validate">
                    <label for="company_name">Company name</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Enter person name"
                           v-model="formData.contact_name"
                           :disabled="this.lockForm"
                           id="contact_name"
                           type="text"
                           class="validate">
                    <label for="contact_name">Contact name</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Enter email"
                           v-model="formData.email"
                           :disabled="this.lockForm"
                           id="email"
                           type="email"
                           class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Enter phone"
                           v-model="formData.phone"
                           :disabled="this.lockForm"
                           id="phone"
                           type="tel"
                           class="validate">
                    <label for="phone">Phone</label>
                </div>
                <div class="input-field col s6">
                    <textarea placeholder="Enter description"
                              v-model="formData.description"
                              :disabled="this.lockForm"
                              id="description"
                              class="materialize-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
                <div class="file-field input-field col s6">
                    <div :class="'btn' + (this.lockForm ? ' disabled': '')">
                        <span>Company Logo</span>
                        <input type="file" id="file" ref="logoFile" @change="handleFileUpload">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" :disabled="this.lockForm" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button
                :class="'waves-effect waves-green btn-flat' + (this.lockForm ? ' disabled' : '')"
                @click="bookPlace">Book</button>
            <button
                    :class="'modal-close waves-effect waves-green btn-flat' + (this.lockForm ? ' disabled' : '')"
                    @click="cancelForm">Cancel</button>
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
                logoFile: null,

                lockForm: false
            }
        },

        mounted() {
            window.M.AutoInit()
        },

        methods: {
            show: function (place) {

                this.place = place
                window.M.updateTextFields()
                const mInst = window.M.Modal
                    .getInstance(this.$el)
                mInst.options.dismissible = false
                mInst.open()
            },

            handleFileUpload: function() {
                this.logoFile = this.$refs.logoFile.files[0]
            },

            bookPlace: function() {
                this.lockForm = true
                const formData = new FormData()

                window._.forEach(this.formData, (value, index) => {
                    formData.append(index, value)
                })

                formData.append('logo_file', this.logoFile)

                axios.post('/book_place', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
            },

            cancelForm: function() {

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
