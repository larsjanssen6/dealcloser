<template>
    <div>
        <div class="modal is-active">
            <div class="modal-background" @click="$emit('close')"></div>
                <div class="modal-content">
                    <slot></slot>
                </div>

            <button class="modal-close" @click="$emit('close')"></button>
        </div>
    </div>
</template>

