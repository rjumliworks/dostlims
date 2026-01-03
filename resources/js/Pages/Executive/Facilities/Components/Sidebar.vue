<template>
    <div class="card bg-light-subtle shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i class="ri-information-fill text-primary fs-24"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span class="text-body">Facility Details</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">Basic Information of the user</p>
                </div>
            </div>
        </div>
        <div class="card-body bg-white rounded-bottom border-bottom">
            <p class="mb-0 text-primary fs-12 fw-semibold">Complete Address</p>
        </div>
        <div class="card bg-white rounded-bottom shadow-none mb-0" style="height: calc(100vh - 398px); overflow: auto;">
            <ul class="list-group list-group-flush border-dashed mb-n4 mt-n3 p-3">
                <li class="list-group-item px-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <i class="ri-map-pin-2-fill text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">{{ facility.barangay.name }}</h6>
                            <p class="fs-11 mb-0 text-muted">Barangay</p>
                        </div>
                    </div>
                </li>
                <li class="list-group-item px-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <i class="ri-treasure-map-fill text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">{{ facility.municipality.name }}</h6>
                            <p class="fs-11 mb-0 text-muted">Municipality</p>
                        </div>
                    </div>
                </li>
                <li class="list-group-item px-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <i class="ri-earth-fill text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0 fs-12">{{ facility.province.name }}</h6>
                            <p class="fs-11 mb-0 text-muted">Province</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props: ['facility'],
    data(){
        return {
    
        }
    },
    methods: { 
       
    }
}
</script>