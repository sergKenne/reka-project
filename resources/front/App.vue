<template>
    <div>
        <Header />
        <main>
           <router-view></router-view>
        </main>
        <Footer />
        <Modal/>
    </div>
</template>

<script setup>
import "../css/app.scss"
import "../css/global.scss"
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import Modal from './components/Modal.vue'

</script>

<style lang="scss" scoped>
    @import url(../css/global.scss);

</style>


