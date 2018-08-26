<template>
    <div>
        <heading class="mb-6" v-html="toolTitle"></heading>

        <div class="card relative">
            <div class="overflow-hidden overflow-x-auto relative">
                <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full">
                    <thead>
                    <tr>
                        <th class="text-left">
                          <span class="inline-flex items-center">
                             Exception
                          </span>
                        </th>
                        <th class="text-left">
                          <span class="inline-flex items-center">
                             Date
                          </span>
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="exceptionRecord in resourceData">
                        <td>
                            <span class="whitespace-no-wrap text-left">
                                {{ exceptionRecord.exception | str_limit(75) }}
                            </span>
                        </td>
                        <td>
                            <span class="whitespace-no-wrap text-left">
                                {{ exceptionRecord.created_at }}<br />
                                {{ exceptionRecord.human_date }}
                            </span>
                        </td>
                        <td class="td-fit text-right pr-6">
                            <span>
                                <router-link
                                        :to="{name: 'nova-larabug-show', params: {id: exceptionRecord.id}}"
                                        class="cursor-pointer text-70 hover:text-primary mr-3">
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg" width="22" height="18"
                                            viewBox="0 0 22 16"
                                            aria-labelledby="view" role="presentation" class="fill-current">
                                        <path
                                                d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                                    </svg>
                                </router-link>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-20 rounded-b">
                <nav class="flex">
                    <button
                            rel="prev"
                            class="btn btn-link py-3 px-4"
                            @click="prevPage"
                            :class="buttonIsActive('prev')"
                            :disabled="!prev || loading"
                    >
                        Previous
                    </button>
                    <button
                            rel="next"
                            class="ml-auto btn btn-link py-3 px-4"
                            @click="nextPage"
                            :class="buttonIsActive('next')"
                            :disabled="!next || loading"
                    >
                        Next
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                resourceData: {},
                next: 1,
                prev: null,
                last: null,
                requestData: {},
            }
        },

        computed: {
            toolTitle() {
                return Nova.config.tool_title;
            }
        },

        mounted() {
            this.refreshPage();
        },

        methods: {
            moment: moment,

            nextPage() {
                if (this.next) {
                    this.next = this.next + 1;
                }
                this.refreshPage();
            },

            prevPage() {
                if (this.prev) {
                    this.next = this.next - 1;
                }
                this.refreshPage();
            },

            refreshPage() {
                this.loading = true;

                Nova.request().get('/nova-vendor/nova-larabug-tool/exceptions?page=' + this.next)
                    .then((response) => {
                        this.loading = false;
                        this.resourceData = response.data.data;
                        this.last = response.data.last_page;
                        this.next = response.data.current_page;
                        this.prev = response.data.current_page;
                    });
            },

            buttonIsActive(type) {
                if (this.loading) {
                    return ['text-80', 'opacity-50'];
                }

                let active = false;
                if (type === 'prev') {
                    if (this.prev > 1) {
                        active = true;
                    } else {
                        active = false;
                    }
                } else if (type === 'next') {
                    if (this.next < this.last) {
                        active = true;
                    } else {
                        active = false;
                    }
                }

                if (active) {
                    return ['text-primary', 'dim'];
                } else {
                    return ['text-80', 'opacity-50'];
                }
            },

            getExceptionExcerpt(content) {
                let body = this.stripTags(content);

                return body > 20 ? body.substring(0, 25) + '...' : body;
            },

            stripTags(text) {
                return text.replace(/(<([^>]+)>)/ig, '');
            }
        },
    }
</script>

<style>
    /* Scoped Styles */
</style>
