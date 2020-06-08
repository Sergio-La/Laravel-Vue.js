<template>
    <div>

        <form @submit.prevent="editarestudiante(estudiante)" v-if="editarActivo">
            <h3>Editar Estudiantes</h3>
            <input type="text" placeholder="Código" class="form-control mb-2" v-model="estudiante.est_cod">
            <input type="text" placeholder="Nombre" class="form-control mb-2" v-model="estudiante.est_nom">
             <input type="text" placeholder="Apellido" class="form-control mb-2" v-model="estudiante.est_ap">
            <input type="text" placeholder="Curso" class="form-control mb-2" v-model="estudiante.est_cur">
            <input type="text" placeholder="Sexo" class="form-control mb-2" v-model="estudiante.sexo">

            <button class="btn btn-primary" type="submit">Guardar Cambios</button>
        </form>
        
        <form @submit.prevent="agregar" v-else>
            <h3>Agregar Estudiantes</h3>
            <input type="text" placeholder="Código" class="form-control mb-2" v-model="estudiante.est_cod">
            <input type="text" placeholder="Nombre" class="form-control mb-2" v-model="estudiante.est_nom">
             <input type="text" placeholder="Apellido" class="form-control mb-2" v-model="estudiante.est_ap">
            <input type="text" placeholder="Curso" class="form-control mb-2" v-model="estudiante.est_cur">
            <input type="text" placeholder="Sexo" class="form-control mb-2" v-model="estudiante.sexo">

            <button class="btn btn-primary" type="submit">Insertar</button>
        </form>

        <hr class="mt-4">
        <h3>Lista de Estudiantes</h3>
        <ul class="list-group my-2">
            
            <li class="list-group-item" v-for="(item, index) in estudiantes" :key="index">
                <p>Código: {{item.est_cod}}</p>
                <p>Nombre: {{item.est_nom}}</p>
                <p>Apellido: {{item.est_ap}}</p>
                <p>Curso: {{item.est_cur}}</p>
                <p>Sexo: {{item.sexo}}</p>
                <button class="btn btn-danger btn-sm" @click="eliminarestudiante(item, index)"> Eliminar </button>
                <button class="btn btn-warning btn-sm" @click="editarformulario(item, index)"> Editar </button>
            </li>

        </ul>
    </div>
</template>

<script>
export default {
    data(){
        return{
            estudiantes: [],
            estudiante: {est_cod: '', est_nom: '',est_ap: '', est_cur: '', sexo: ''},
            editarActivo: false
        }
    },
    created(){
         axios.get('/estudiantes').then( res => {
             this.estudiantes = res.data;
         })
     },
    methods:{
        editarformulario(item){
            this.editarActivo=true;
            this.estudiante.est_cod = item.est_cod;
            this.estudiante.est_nom = item.est_nom;
            this.estudiante.est_ap = item.est_ap;
            this.estudiante.est_cur = item.est_cur;
            this.estudiante.sexo= item.sexo;
            this.estudiante.id = item.id;
            },
        editarestudiante(item){
            const params = {est_cod: item.est_cod, est_nom: item.est_nom, est_ap: item.est_ap, est_cur: item.est_cur, sexo: item.sexo};
            axios.put(`/estudiantes/${item.id}`, params).then(res => {
                const index = this.estudiantes.findIndex(estudianteBuscar => estudianteBuscar.id === res.data.id)

                this.estudiante[index] = res.data;

                axios.get('/estudiantes').then(res => {
                        this.estudiantes = params;
                    })
            })
        },
        agregar(){
            if(this.estudiante.est_cod.trim() == '' || this.estudiante.est_cur.trim() == ''){
                 alert ('Los campos no pueden estar vacíos.');
                 return;    
             }
            const params = {est_cod: this.estudiante.est_cod, est_nom: this.estudiante.est_nom, est_ap: this.estudiante.est_ap, est_cur: this.estudiante.est_cur, sexo: this.estudiante.sexo}
            this.estudiante.est_cod='';
            this.estudiante.est_nom='';
            this.estudiante.est_ap='';
            this.estudiante.est_cur='';
            this.estudiante.sexo='';
            
            axios.post('/estudiantes', params).then( res => {
                     this.estudiantes.push(res.data)
            })
         },
         eliminarestudiante(item, index){
             axios.delete(`/estudiantes/${item.id}`).then(() =>{
             this.estudiantes.splice(index,1);
        })
        }
    
    }
}
</script>