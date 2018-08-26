<template>
    <div>
        <slot>
            <h4 class="text-90 font-normal text-2xl mb-3">Exception</h4>
        </slot>

        <card class="mb-6 py-3 px-6">
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Exception</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90" v-html="exceptionData.exception"></p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Date</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90" v-html="exceptionData.created_at"></p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">File</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90" v-html="exceptionData.file"></p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">URL</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90" v-html="exceptionData.fullUrl"></p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Error</h4>
                </div>
                <div class="w-3/4 py-4">
                    <pre class="text-90" v-html="exceptionData.error"></pre>
                </div>
            </div>
        </card>
    </div>
</template>

<script>
    export default {
        props: {
            id: {}
        },

        data() {
            return {
                exceptionData: {}
            }
        },

        mounted() {
            this.getException();
        },

        methods: {
            getException() {
                Nova.request().get('/nova-vendor/nova-larabug-tool/exceptions/' + this.id)
                    .then((response) => {
                        this.exceptionData = response.data;
                    });
            }
        }
    }
</script>

<style scoped>
    pre {
        background-color: #f3f0f0;
        overflow: auto;
        padding: 5px;
    }
</style>
