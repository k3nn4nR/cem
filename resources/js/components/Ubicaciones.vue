<template>
    <v-card flat>
        <v-card-text>
            {{persona}}
        </v-card-text>
        <v-card-actions>
            <v-btn class="error" @click="close">Cancelar</v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    props:['persona'],
    data(){
        return {

        };
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){
            axios.get('/persona-contactos/'+this.persona).then(response=>{this.contactos=response.data})
        },
        close(){
            this.$emit('delete');
        }
    }
}
</script>