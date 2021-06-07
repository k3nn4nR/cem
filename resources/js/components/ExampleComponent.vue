<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <Persona/>
                        <Casos/>                        
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Persona from  './Personas.vue';
    import Casos from  './Casos.vue';
    export default {
        components:{
            Persona,
            Casos,
        },
        data(){
            return {

            };
        },
        mounted() {

        },
        methods:{

        }
    }
</script>
