Vue.use(VueResource);

// componente principal
const index = {
    template: '#output_index',
    data: function(){
        return {
            msj: "Hola",
            lista: []
        }
    },
    methods: {
        get: function(){
            this.$http.get(window.site_url + 'logistics/output/get').then(
                response => {
                    this.lista = response.data
                    console.log(response.data)
                }
            )
        }
    },
    created: function(){
        this.get();
    }
}

const create = {
    template: '#output_create',
    data: function(){
        return {
            output: {
                ticketId: 1,
                storageIdOut: 1,
                storageIdIn: 1,
                date: 'YYYY-MM-DD'
            },
            outputdetail: [],
            outputNew: {
                product: {},
                unitPrice: 0.00,
                quantity: 0,
                lot: "",
            }
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