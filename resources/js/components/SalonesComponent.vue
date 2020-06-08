<template>
    <div>

        <form @submit.prevent="editarsalon(salon)" v-if="editarActivo">
            <h3>Editar Salones</h3>
            <input type="text" placeholder="Código" class="form-control mb-2" v-model="salon.sal_cod">
            <input type="text" placeholder="Curso" class="form-control mb-2" v-model="salon.sal_cur">
            <button class="btn btn-warning" type="submit">Guardar Cambios</button>
        </form>

        <form @submit.prevent="agregar" v-else>
            <h3>Agregar Salones</h3>
            <input type="text" placeholder="Código" class="form-control mb-2" v-model="salon.sal_cod">
            <input type="text" placeholder="Curso" class="form-control mb-2" v-model="salon.sal_cur">
            <button class="btn btn-primary" type="submit">Insertar</button>
        </form>

        <hr class="mt-4">
        <h3>Lista de Salones</h3>
        <ul class="list-group my-2">
            
            <li class="list-group-item" v-for="(item, index) in salones" :key="index">
                <p>Código: {{item.sal_cod}}</p>
                <p>Curso: {{item.sal_cur}}</p>
                <button class="btn btn-danger btn-sm" @click="eliminarsalon(item, index)"> Eliminar </button>
                <button class="btn btn-warning btn-sm" @click="editarformulario(item, index)"> Editar </button>
            </li>

        </ul>
    </div>
</template>

<script>
export default {
    data(){
        return{
            salones: [],
            salon: {sal_cod: '', sal_cur: ''},
            editarActivo: false
        }
    },
    created(){
        axios.get('/salones').then( res => {
            this.salones = res.data;
        })
    },
    methods:{
        editarformulario(item){
            this.editarActivo=true;
            this.salon.sal_cod = item.sal_cod;
            this.salon.sal_cur = item.sal_cur;
            this.salon.id = item.id;
            },
        editarsalon(item){
            const params = {sal_cod: item.sal_cod, sal_cur: item.sal_cur};
            axios.put(`/salones/${item.id}`, params).then(res => {
                const index = this.salones.findIndex(salonBuscar => salonBuscar.id === res.data.id)

                this.salon[index] = res.data;

                axios.get('/salones').then(res => {
                        this.salones = params;
                    })
            })
        },
        agregar(){
            if(this.salon.sal_cod.trim() == '' || this.salon.sal_cur.trim() == ''){
                alert ('Los campos no pueden estar vacíos.');
                return;    
            }
            //console.log(this.salon.sal_cod, this.salon.sal_cur);
            const params = {sal_cod: this.salon.sal_cod, sal_cur: this.salon.sal_cur}
            this.salon.sal_cod='';
            this.salon.sal_cur='';
            
            axios.post('/salones', params).then( res => {
                    this.salones.push(res.data)
            })
         },
         eliminarsalon(item, index){
             axios.delete(`/salones/${item.id}`).then(() =>{
                 this.salones.splice(index,1);
             })
        }     
    }
}
</script>