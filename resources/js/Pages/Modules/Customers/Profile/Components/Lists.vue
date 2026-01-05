<template>
    <div class="table-responsive table-card" style="height: calc(100vh - 443px);">
        <table class="table table-nowrap align-middle mb-0">
            <thead class="bg-primary text-white">
                <tr class="fs-10">
                    <th style="width: 4%;"></th>
                    <th style="width: 20%;">Code</th>
                    <th style="width: 25%;" class="text-center">Request At</th>
                    <th style="width: 16%;" class="text-center">Status</th>
                    <th style="width: 15%;" class="text-center">Total</th>
                    <th style="width: 10%;" class="text-center">Payment</th>
                </tr>
            </thead>
            <tbody v-if="lists.length > 0">
                <tr v-for="(list,index) in lists" v-bind:key="index" class="fs-12">
                    <td>{{ (meta.current_page - 1) * meta.per_page + index + 1 }}.</td>
                    <td>{{list.code}}</td>
                    <td class="text-center">{{list.created_at}}</td>
                    <td class="text-center"><span :class="'badge '+list.status.color">{{list.status.name}}</span></td>
                    <td class="text-center">{{list.payment.total}}</td>
                    <td class="text-center">
                        <i v-if="list.payment.is_paid" class="ri-checkbox-circle-fill text-success fs-18" v-b-tooltip.hover :title="list.payment.status.name"></i>
                        <i v-else-if="list.payment.is_free" class="ri-checkbox-circle-fill text-warning fs-18" v-b-tooltip.hover title="Gratis"></i>
                        <i v-else class="ri-close-circle-fill text-danger fs-18" v-b-tooltip.hover :title="list.payment.status.name"></i>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="6" class="text-center text-muted">No records found.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer" style="margin-left: -15px; margin-right: -15px;">
        <Pagination class="ms-2 me-2 mt-n1 mb-n3" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
    </div>
</template>
<script>
import _ from 'lodash';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination },
    props: ['id'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            filter : {
                keyword: null,
            }
        }
    },
    watch: {
        "filter.keyword"(newVal){
            this.checkSearchStr(newVal)
        },
    },
    created(){
        this.fetch();
    },
    methods: {
         checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/customers';
            axios.get(page_url,{
                params : {
                    id: this.id,
                    option: 'tsrs',
                    keyword : this.keyword,
                    count: 10
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data.data;                    
                    this.meta = response.data.meta;
                    this.links = response.data.links;
                }
            })
            .catch(err => console.log(err));
        },
    }
}
</script>