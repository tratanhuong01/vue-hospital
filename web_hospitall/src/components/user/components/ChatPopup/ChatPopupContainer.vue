<template>
    <div class="chat-popup__form" :class="isShow ? 'active' : ''">
        <p class="chat-popup__form--title">
            {{ isLogin === 1 ? 'Hổ trợ trực tuyến' : 'Nhập thông tin' }}
        </p>
        <div @click="handleClose" class="chat-popup__form--close bx bx-x"></div>
        <ChatPopupForm v-if="isLogin === 0" :setIsLogin="setIsLogin" />
        <ChatPopupContent v-if="isLogin === 2" :setIsLogin="setIsLogin" />
        <ChatPopupWating v-if="isLogin === 1" :setIsLogin="setIsLogin" />
    </div>
</template>
<script>
import ChatPopupForm from './ChatPopupForm.vue';
import ChatPopupContent from '../../../ChatPopupContent.vue';
import ChatPopupWating from './ChatPopupWating.vue';
export default {
    props: ["isShow", "setIsShow"],
    data() {
        return {
            isLogin: 0,
            isSuccess: false,
        }
    },
    methods: {
        handleClose: function () {
            this.setIsShow(false);
        },
        setIsLogin: function (isLogin) {
            this.isLogin = isLogin;
        }
    },
    components: { ChatPopupForm, ChatPopupContent, ChatPopupWating }
}
</script>