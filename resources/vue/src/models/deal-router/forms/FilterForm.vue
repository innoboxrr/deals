<template>

    <form id="dealRouterFilterForm" @submit.prevent="onSubmit">

        <div class="uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>

            <!-- LAST RUN -->
            <text-input-component
                :custom-class="inputClass"
                name="last_run"
                label="Última ejecución"
                placeholder="YYYY-MM-DD HH:mm:ss"
                v-model="last_run" />

            <!-- QUEUE -->
            <text-input-component
                :custom-class="inputClass"
                name="queue"
                label="Cola"
                v-model="queue" />

            <!-- DEAL ID -->
            <text-input-component
                :custom-class="inputClass"
                name="deal_id"
                label="ID del Deal"
                v-model="deal_id" />

        </div>

        <div class="uk-flex uk-flex-right uk-child-width-auto@m uk-child-width-1-1@m" uk-grid>
            <div>
                <button :class="buttonClass">
                    Buscar
                </button>
            </div>
            <div>
                <button 
                    :class="buttonClass + ' bg-gray-400'"
                    @click.prevent="resetForm()">
                    Resetear
                </button>
            </div>
        </div>

    </form>

</template>

<script>

import { TextInputComponent } from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
    },

    emits: ['submit'],

    data() {
        return {
            last_run: '',
            queue: '',
            deal_id: '',
        }
    },

    methods: {

        onSubmit() {
            this.$emit('submit', { ...this.$data })
        },

        resetForm() {
            Object.assign(this.$data, this.$options.data())
            this.onSubmit()
        }

    }

}
</script>
