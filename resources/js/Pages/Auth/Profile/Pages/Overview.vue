<template>
    <div class="">
        <form @submit.prevent="submit()" class="customform">
            <BCard no-body>
                <BCardHeader>
                    <BCardTitle>Overview</BCardTitle>
                    <p class="text-muted mb-0">This is your personal hub where you can manage your account details, preferences, and interactions within our platform. </p>
                </BCardHeader>
                <BCardBody class="p-4" style="height: calc(100vh - 300px); overflow: auto;">
                    
                </BCardBody>
            </BCard>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
           
        }
    },
}
</script>