<template>
    <v-card>
        <v-card-text>
            
        </v-card-text>
    </v-card>
</template>
<script>
export default {
    data(){
        return {
            casos:[],
        };
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){
            axios.get('caso').then(response=>{this.casos=response.data})
        }
    }
}
</script>