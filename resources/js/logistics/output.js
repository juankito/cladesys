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
            this.$http.get(window.site_url + 'logistics/ouput/delete', 
            //options
            {
                params: {
                    id
                }
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
        registrar () {
            // this.$http.post(window.site_url + 'logistics/output/create', 
            // // option
            // {
            //     body: {
            //         cabecera: this.output,
            //         detalles: this.outputdetail
            //     }
            // }).then( response => {
            //     showMe(response)
            // })
            $.post(
                window.site_url + 'logistics/output/create',
                {
                    cabecera: this.output,
                    detalles: this.outputdetail
                }
            ).bind(this)
        },
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
        agregarOutput () {
            this.outputNew.product = JSON.parse(this.outputNew.product)
            this.outputdetail.push(JSON.parse(JSON.stringify(this.outputNew)))
        }
    }
}
const Bar = { template: '<div>bar</div>' }

const routes = [
    { path: '/', component: index },
    { path: '/create', component: create },
    { path: '/bar', component: Bar }
]

const router = new VueRouter({
    routes
})

new Vue({
    router,
    el: '#main'
})