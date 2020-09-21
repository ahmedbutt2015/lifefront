<template>
    <div class="wrapper">
        <div class="inner">
            <img src="/images/image-1.png" alt="" class="image-1">
            <router-view></router-view>
            <img src="/images/image-2.png" alt="" class="image-2">
        </div>
    </div>
</template>
<style>
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    .alert {
        position: relative;
        padding: .75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: .25rem;
    }
</style>
