<template>
    <form method="POST" id="businessForm" @submit.prevent="onSubmit" @keydown="form.errors.clear()">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <input type="hidden" v-model="form.id" name="id">
            <div :class="getClass('razon_social')">
                <label>Razón Social</label>
                <input type="text" name="razon_social" placeholder="Razon Social" v-model="form.razon_social" class="form-control">
                <span class="help-block"></span>
            </div>

            <div :class="getClass('company_name')">
                <label>Nombre</label>
                <input type="text" name="company_name" placeholder="Nombre de la Compañia, Restaurant, Evento..." v-model="form.company_name" class="form-control">
                <span class="help-block"
                      v-if="form.errors.has('company_name')"
                      v-text="form.errors.get('company_name')"></span>
            </div>

            <div :class="getClass('company_location')">
                <label>Dirección</label>
                <input type="text" name="company_location" placeholder="Dirección" v-model="form.company_location" class="form-control">
                <span class="help-block"></span>
            </div>

            <br>
            <upload-image :url="form.company_logo" v-model="form.company_logo" name="company_logo"></upload-image>

            <button type="submit" class="btn btn-primary btn-raised btn-block ripple-effect" :disabled="form.errors.any()">
                {{submit_text}}
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['business'],

        data(){
            return {
                data: this.business,
                form: new Form(JSON.parse(this.business)),
                submit_text: 'GUARDAR'
            }
        },

        mounted() {

        },

        methods: {
            onSubmit: function(){
                var _this = this;
                this.submit_text = 'GUARDANDO...';
                this.form.setFormElement(document.getElementById('businessForm'));
                this.form.post('/admin/business/store')
                        .then(function(response){
                            window.location.href = '/admin/manage/business';
                        }, function(response){
                            _this.submit_text = 'GUARDAR';
                        });
            },
            getClass: function(type){
                return this.form.errors.has(type) ? 'form-group has-error' : 'form-group'
            },

            company_logo: function(){
                return this.form.company_logo
            }
        }
    }
</script>
