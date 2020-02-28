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
                    <p class="text-90 mb-2" v-html="exceptionData.exception"></p>

                    <a v-if="exceptionData && exceptionData.project" target="_blank" class="no-underline" :href="`https://www.larabug.com/panel/projects/${exceptionData.project.id}/exceptions/${exceptionData.id}`">View exception in LaraBug.com</a>
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
                    <h4 class="font-normal text-80">URL</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90" v-html="exceptionData.url"></p>
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
                    <h4 class="font-normal text-80">Line</h4>
                </div>
                <div class="w-3/4 py-4">
                    <p class="text-90" v-html="exceptionData.line"></p>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Exception</h4>
                </div>
                <div class="w-3/4 py-4">
                    <pre class="line-numbers bg-black overflow-auto text-white leading-normal"
                         v-if="exceptionData.executor && exceptionData.executor[0] && exceptionData.executor[0].line_number"
                         v-bind:class="[exceptionData.markup_language]"
                         :data-start="exceptionData.executor[0].line_number"
                         :data-line="exceptionData.line"><code v-text="exceptionData.executor_output"></code></pre>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/4 py-4">
                    <h4 class="font-normal text-80">Stack trace</h4>
                </div>
                <div class="w-3/4 py-4">
                    <pre class="text-90 bg-black overflow-auto text-white leading-normal p-3" v-html="exceptionData.error"></pre>
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
                        this.exceptionData = response.data.data;
                    })
            }
        }
    }
</script>
