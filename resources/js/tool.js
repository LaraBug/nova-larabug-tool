Nova.booting((Vue, router) => {
    Vue.config.devtools = true;

    Vue.filter('str_limit', function (body, limit = 25) {
        if(!body){
            return body;
        }
        return body.length > limit ? body.substring(0, limit) + '...' : body;
    });

    router.addRoutes([
        {
            name: 'nova-larabug-tool',
            path: '/nova-larabug-tool',
            component: require('./components/Tool'),
        },
        {
            name: 'nova-larabug-show',
            path: '/nova-larabug-tool/:id',
            component: require('./components/ShowException'),
            props: route => {
                return {
                    id: route.params.id,
                }
            },
        }
    ])
})
