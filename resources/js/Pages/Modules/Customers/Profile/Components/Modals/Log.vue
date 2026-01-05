<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 650px;" header-class="p-3 bg-light" title="View Log" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <div v-if="selected" class="row mb-3">
            <div class="col-md-12">
                <div class="row align-items-center g-3">
                    <div class="col-md">
                        <div>
                            <h6><span class="fw-semibold text-primary fs-15"><span class="text-capitalize">{{ selected.event }}</span> {{selected.log_name}}</span></h6>
                            <div class="hstack gap-3  fs-12 flex-wrap">
                                <div>Date : 
                                    <span class="fw-medium">{{ formatDate(selected.created_at) }}</span>
                                </div>
                                <div class="vr" style="width: 1px;"></div>
                                <div>User : 
                                    <span class="fw-medium">{{selected.causer.profile.fullname}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="text-muted mt-0"/>
        <div class="row mt-2">
            <div class="col-sm-12">
                <table class="table table-nowrap table-bordered align-middle mb-0">
                    <thead class="bg-primary text-white thead-fixed">
                        <tr class="fs-11">
                            <th style="width: 33.3%;" class="text-center">Field</th>
                            <th style="width: 33.3%;" class="text-center">Old</th>
                            <th style="width: 33.3%;" class="text-center">New</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in changedFields" :key="index">
                            <td class="text-center text-capitalize">{{ item.field.replace('_', ' ') }}</td>
                            <td class="text-center text-muted">{{ item.old }}</td>
                            <td class="text-center fw-semibold">{{ item.new }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Close</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            selected: null,
            showModal: false
        }
    },
    computed: {
        changedFields() {
            if (!this.selected?.properties) {
                return []
            }

            const oldData = this.selected.properties.old || {}
            const newData = this.selected.properties.attributes || {}

            return Object.keys(newData).map(key => ({
                field: key,
                old: oldData[key] ?? '—',
                new: newData[key] ?? '—',
            }))
        }
    },
    methods: { 
        show(data){
            this.selected= data;
            this.showModal = true;
        },
        formatDate(dateString) {
            const date = new Date(dateString)

            return date.toLocaleString('en-PH', {
                year: 'numeric',
                month: 'long',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            })
        },
        hide(){
            this.selected = null;
            this.showModal = false;
        }
    }
}
</script>