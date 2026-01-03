<script>
import { layoutComputed } from "@/Shared/State/helpers";
export default {
    computed: {
        ...layoutComputed
    },
    created: () => {
    document.body.removeAttribute("data-layout", "horizontal");
    document.body.removeAttribute("data-topbar", "dark");
    document.body.removeAttribute("data-layout-size", "boxed");
  },
    mounted() {
        if (localStorage.getItem('hoverd') == 'true') {
        document.documentElement.setAttribute('data-sidebar-size', 'sm-hover-active');
        }

        document.getElementById('overlay').addEventListener('click', () => {
        document.body.classList.remove('vertical-sidebar-enable');
        });
    }
};
</script>

<template>
     <div id="layout-wrapper" class="app-container">
        <slot />
    </div>
</template>
