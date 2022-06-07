<template>
    <div class="popup_waiting">
        <div>
            <p><span class="bx bx-loader loading"></span></p>
            <p>Đang chờ bác sĩ tư vấn...</p>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';

export default {
    props: ['setIsLogin'],
    computed: {
        ...mapState(['socket'])
    },
    mounted() {
        this.socket.on(`_acceptJoin.all`, () => {
            this.setIsLogin(2);
        });
    }
}
</script>