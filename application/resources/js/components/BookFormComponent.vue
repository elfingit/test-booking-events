<template>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Book for - {{ place.price }}</h4>
            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input placeholder="Enter company name"
                               v-model="formData.company_name"
                               :disabled="this.lockForm"
                               id="company_name"
                               type="text"
                               :class="getInputClass('company_name')">
                        <label for="company_name">Company name</label>
                        <span
                            class="helper-text"
                            :data-error="getFormError('company_name')"></span>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field">
                        <input placeholder="Enter person name"
                               v-model="formData.contact_name"
                               :disabled="this.lockForm"
                               id="contact_name"
                               type="text"
                               :class="getInputClass('contact_name')">
                        <label for="contact_name">Contact name</label>
                        <span
                            class="helper-text"
                            :data-error="getFormError('contact_name')"></span>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field">
                        <input placeholder="Enter email"
                               v-model="formData.email"
                               :disabled="this.lockForm"
                               id="email"
                               type="email"
                               :class="getInputClass('email')">
                        <label for="email">Email</label>
                        <span
                            class="helper-text"
                            :data-error="getFormError('email')"></span>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field">
                        <input placeholder="Enter phone"
                               v-model="formData.phone"
                               :disabled="this.lockForm"
                               id="phone"
                               type="tel"
                               :class="getInputClass('phone')">
                        <label for="phone">Phone</label>
                        <span
                            class="helper-text"
                            :data-error="getFormError('phone')"></span>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field">
                        <textarea placeholder="Enter description"
                                  v-model="formData.description"
                                  :disabled="this.lockForm"
                                  id="description"
                                  :class="'materialize-textarea ' + getInputClass('description')"></textarea>
                        <label for="description">Description</label>
                        <span
                            class="helper-text"
                            :data-error="getFormError('description')"></span>
                    </div>
                </div>
                <div class="col s6">
                    <div class="file-field input-field">
                        <div :class="'btn' + (this.lockForm ? ' disabled': '')">
                            <span>Company Logo</span>
                            <input type="file" id="file" ref="logoFile" @change="handleFileUpload">
                        </div>
                        <div class="file-path-wrapper">
                            <input
                                :class=" 'file-path ' + getInputClass('logo_file')"
                                :disabled="this.lockForm" type="text">
                            <span
                                class="helper-text"
                                :data-error="getFormError('logo_file')"></span>
                        </div>
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

                formErrors: {},

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
                this.formErrors = {}
                const formData = new FormData()

                window._.forEach(this.formData, (value, index) => {

                    if (value.trim().length > 0) {
                        formData.append(index, value)
                    }
                })

                formData.append('logo_file', this.logoFile)
                formData.append('place_id', this.place.id)

                axios.post('/api/reserve_place', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then( response  => {

                })
                .catch( e => {

                    if (e.request && e.request.status === 422) {
                        this.formErrors = e.response.data.errors
                    } else {
                        console.log(e)
                        alert('Something went wrong please try again later')
                    }

                })
                .finally( () => {
                    this.lockForm = false
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

                this.formErrors = {}
            },

            getInputClass: function (name) {
                return this.formErrors[name] ? ' invalid' : 'valid'
            },

            getFormError: function (name) {
                return this.formErrors[name] ? this.formErrors[name][0] : ''
            }
        }
    }
</script>

<style scoped>
 span.helper-text {
     position: absolute;
     top: 4rem;
     width: 200px;
 }
 .input-field {
     min-height: 4rem;
     margin-top: 1rem;
 }

</style>
