function showMe(arg){
    if(typeof arg === 'object'){
        console.log(JSON.stringify(arg))
    }else{
        console.log(arg)
    }
}

Vue.use(VueResource);

// componente principal
const index = {
    template: '#output_index',
    data: function(){
        return {
            searchOutput: "",
            lista: []
        }
    },
    methods: {
        deleteOutput (id) {
            if(confirm('Eliminar el registro ' + id))
            this.$http.get(window.site_url + 'logistics/output/delete', 
            //options
            {
                params: {
                    id
                }
            }).then( response => {
                this.get()
            })
        },
        get: function(){
            this.$http.get(window.site_url + 'logistics/output/get', 
            // options
            {
                params: {
                    search: this.searchOutput
                }
            }).then(
                response => {
                    this.lista = response.data
                }
            )
        }
    },
    created: function(){
        this.get();
    }
}

const initOutput = {
    ticketId: 1,
    storageIdOut: 1,
    storageIdIn: 1,
    date: ''
}
const  initOutputNew = {
    product: {},
    unitPrice: 0.00,
    quantity: 0,
    lot: "",
}

// componente de creacion
const create = {
    template: '#output_create',
    data: function(){
        return {
            output: initOutput,
            outputdetail: [],
            outputNew: initOutputNew
        }
    },
    computed: {
        getOutputTotal () {
            var total = 0
            for(i in this.outputdetail){
                total += (this.outputdetail[i].quantity * this.outputdetail[i].unitPrice)
            }
            return total
        }
    },
    mounted: function(){
    },
    methods: {
        registrar () {
            this.$http.post(window.site_url + 'logistics/output/create', 
            // body
            {
                cabecera: this.output,
                detalles: this.outputdetail
            },
            // option
            {
                emulateJSON: true
            }).then( 
            // success
            response => {
                // showMe(response.body)
                swal({
                    title: '¡Éxito!',
                    type: 'success',
                    html: 'Producto #'+ response.body + ' registrado',
                    timer: 5000
                }).catch(swal.noop)
            },
            // error
            response => {
                // showMe(response.body)
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: response.body
                }).catch(swal.noop)
            })
            // $.post(
            //     window.site_url + 'logistics/output/create',
            //     {
            //         cabecera: this.output,
            //         detalles: this.outputdetail
            //     }
            // ).bind(this)
        },
        agregarOutput () {
            this.outputNew.product = JSON.parse(this.outputNew.product)
            this.outputdetail.push(JSON.parse(JSON.stringify(this.outputNew)))
            this.outputNew = initOutputNew
        }
    }
}
const detail = {
    template: '#output_detail',
    data () {
        return {
            datos: {}
        }
    },
    props: ['id'],
    created () {
        this.$http.get(window.site_url + 'logistics/output/detail', {
            params: {
                id: this.id
            }
        }).then(response => {
            this.datos = response.body
        })
    },
    computed: {
        getOutputTotal () {
            var total = 0
            for(i in this.datos.detalles){
                total += (this.datos.detalles[i].quantity * this.datos.detalles[i].unitprice)
            }
            return total
        }
    }
}

const routes = [
    { path: '/', component: index },
    { path: '/create', component: create },
    { path: '/detail/:id', component: detail , props: true }
]

const router = new VueRouter({
    routes
})

new Vue({
    router,
    el: '#main'
})