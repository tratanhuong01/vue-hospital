<template>
    <span class="green" @click="handleStatus" v-if="!loading" :style="{ background: status.color }">{{
            status.name
    }}</span>
</template>
<script>
export default {
    props: ['statusMain'],
    data() {
        return {
            status: {
                name: '',
                value: '',
                color: ''
            }
        }
    },
    methods: {
        statusItem: function (status) {
            switch (status) {
                case -1:
                    this.status.name = 'Đã huỷ';
                    this.status.value = -1;
                    this.status.color = 'gray';
                    break;
                case 0:
                    this.status.name = 'Huỷ';
                    this.status.value = 0;
                    this.status.color = 'red';
                    break;
                case 1:
                    this.status.name = 'Đã duyệt';
                    this.status.value = 1;
                    this.status.color = 'green';
                    break;
                case 2:
                    this.status.name = 'Đã khám';
                    this.status.value = 2;
                    this.status.color = 'var(--color-bold)';
                    break;
            }
        },
    },
    mounted() {
        this.statusItem(this.statusMain);
    }
}
</script>