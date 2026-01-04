<template>
    <form class="app-search d-none d-md-block" style="margin-top: -25px;">
        <div class="position-relative">
            <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" />
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span @click="names = []" class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
        </div>
        <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
            <SimpleBar data-simplebar style="max-height: height: calc(100vh/2 - 326px)">
                <div class="notification-list">
                    <b-link @click="chooseName(list)" v-for="(list, index) of names" :key="index" class="d-flex dropdown-item notify-item py-2">
                        <div class="flex-1">
                            <h6 class="m-0">{{ list.name}}</h6>
                        </div>
                    </b-link>
                    <div class="d-flex" v-if="showButton" >
                        <div class="flex-grow-1">
                            <span class="text-muted fs-12 mt-3 ms-3">Do you wish to add new customer name? we haven't found any duplicate</span>
                        </div>
                        <div class="flex-shrink-0">
                            <b-button @click="newCustomer()" variant="primary" class="me-2" size="sm" block>New Customer name</b-button>
                        </div>
                    </div>
                </div>
            </SimpleBar>
        </div>
    </form>
</template>
<script>
import _ from 'lodash';
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            names: [],
            showButton: false,
            keyword: null
        }
    },
    mounted() {
        this.isCustomDropdown();
    },
    methods: {
        checkSearchStr: _.debounce(function (string) {
            this.keyword = string;
            this.search();
        }, 200),
        search(){
            axios.get('/customers', {
                params: {
                    keyword: this.keyword,
                    option: 'search'
                }
            })
            .then(response => {
                if(response.data.length > 0){ 
                    this.names = response.data; 
                    this.showButton = false;
                }else{
                    this.names = [];
                    // this.clear();
                    this.showButton = true;
                }
            })
            .catch(err => console.log(err));
        },
        chooseName(data){
            this.$emit('set',data);
        },  
        clear(){
            this.$emit('set',null);
        },
        newCustomer(){
            this.$emit('new',this.keyword);
        },
        isCustomDropdown() {
            var searchOptions = document.getElementById("search-close-options");
            var dropdown = document.getElementById("search-dropdown");
            var searchInput = document.getElementById("search-options");

            searchInput.addEventListener("focus", () => {
                var inputLength = searchInput.value.length;
                if (inputLength > 0) {
                    dropdown.classList.add("show");
                    searchOptions.classList.remove("d-none");
                } else {
                    dropdown.classList.remove("show");
                    searchOptions.classList.add("d-none");
                }
            });

            searchInput.addEventListener("keyup", () => {
                var inputLength = searchInput.value.length;
                if (inputLength > 0) {
                    dropdown.classList.add("show");
                    searchOptions.classList.remove("d-none");
                    this.checkSearchStr(searchInput.value);
                } else {
                    this.keyword = searchInput.value;
                    dropdown.classList.remove("show");
                    searchOptions.classList.add("d-none");
                }
            });

            searchOptions.addEventListener("click", () => {
                searchInput.value = "";
                dropdown.classList.remove("show");
                searchOptions.classList.add("d-none");
            });

            document.body.addEventListener("click", (e) => {
                if (e.target.getAttribute("id") !== "search-options") {
                    dropdown.classList.remove("show");
                    searchOptions.classList.add("d-none");
                }
            });
        }
    }
}
</script>
<style scoped>
    .dropdown-menu-lg {
        width: 98%;
    }
</style>