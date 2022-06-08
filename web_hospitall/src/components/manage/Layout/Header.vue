<template>
    <div class="admin type02">
        <div class="admin__header">
            <div class="admin__header--logo">
                <a href="">
                    <img src="@/assets/img/logo/logo.svg" alt="MH CARE">
                </a>
                <span class="bx bx-menu box-icon" @click="toggleMenu"></span>
            </div>
            <div class="admin__header--content">
                <div class="admin__header--search">
                    <span class="bx bx-search"></span>
                    <input type="text" placeholder="Search">
                    <span class="bx bx-x"></span>
                </div>
                <div class="admin__header--right">
                    <span class="bx bx-bell box-icon"></span>
                    <div>
                        <img src="https://berrydashboard.io/static/media/user-round.13b5a31b.svg" alt="" srcset="">
                        <span class="bx bx-user-pin"></span>
                        <span @click="logOut" class="bx bx-log-out"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex'
import { inject } from 'vue'
export default {
    setup() {
        const slideMenu = inject('btn_menu');
        return { slideMenu };
    },
    computed: {
        ...mapState(['admin']),
    },
    mounted() {

    },
    methods: {
        ...mapMutations(['setadmin']),
        toggleMenu: function () {
            // this.slideMenu.classList.toggle('active');
            this.slideMenu = !this.slideMenu
        },
        logOut: function () {
            this.setadmin(null);
            window.localStorage.removeItem('K-admin');
            this.$router.push({ name: 'admin_login' })
        }
    }
}
</script>
