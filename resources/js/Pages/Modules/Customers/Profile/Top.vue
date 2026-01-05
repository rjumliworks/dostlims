<template>
    <b-row>
        <b-col lg="12">
            <b-card no-body class="mt-n4 mx-n4">
                <div class="bg-warning-subtle">
                    <b-card-body class="pb-0 px-4">
                        <b-row class="mb-3">
                            <b-col md>
                                <b-row class="align-items-center g-3">
                                    <b-col md="auto">
                                        <div class="avatar-md">
                                            <span :class="'avatar-title rounded-circle bg-primary text-white fs-24'">{{customer.data.customer[0]}}</span>
                                        </div>
                                    </b-col>
                                    <b-col md>
                                        <div>
                                            <h4 class="fw-bold">{{customer.data.customer_name}}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i>{{ customer.data.name }}</div>
                                                <div class="vr" style="width: 1px;"></div>
                                                <div><span class="text-muted">Classification : </span>{{ customer.data.classification.name }}</div>
                                                <div class="vr" style="width: 1px;"></div>
                                                <div><span class="text-muted">Industry : </span>{{ customer.data.industry.name }}</div>
                                                <div class="vr" style="width: 1px;"></div>
                                                <div><span class="text-muted">Sex : </span>{{ customer.data.sex.name }}</div>
                                                <div class="vr" style="width: 1px;"></div>
                                                <div><i class="ri-map-pin-2-fill text-muted align-bottom me-1"></i>{{ customer.data.address.name }}</div>
                                            </div>
                                        </div>
                                    </b-col>
                                </b-row>
                            </b-col>
                            <b-col md="auto">
                                <div class="hstack gap-1 flex-wrap">
                                    <Link href="/customers"><button type="button" class="btn py-0 fs-16 text-body">
                                        <i class="ri-share-line"></i>
                                    </button></Link>
                                </div>
                            </b-col>
                        </b-row>
                        
                    </b-card-body>
                </div>
            </b-card>
        </b-col>
    </b-row>
</template>
<script>
export default {
    props: ['customer'],
    data(){
        return {
            currentUrl: window.location.origin,
        }
    }
}
</script>
