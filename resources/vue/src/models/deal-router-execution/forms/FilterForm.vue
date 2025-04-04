<template>

    <form id="dealRouterExecutionFilterForm" @submit.prevent="onSubmit">

        <div class="uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>

            <!-- START EXECUTION -->
            <text-input-component
                :custom-class="inputClass"
                name="start_execution"
                label="Inicio de ejecución"
                placeholder="YYYY-MM-DD HH:mm:ss"
                v-model="start_execution" />

            <!-- END EXECUTION -->
            <text-input-component
                :custom-class="inputClass"
                name="end_execution"
                label="Fin de ejecución"
                placeholder="YYYY-MM-DD HH:mm:ss"
                v-model="end_execution" />

            <!-- ASSIGNMENT LOG -->
            <textarea-input-component
                :custom-class="inputClass"
                name="assignment_log"
                label="Texto en log"
                v-model="assignment_log" />

            <!-- DEAL ROUTER ID -->
            <text-input-component
                :custom-class="inputClass"
                name="deal_router_id"
                label="ID del DealRouter"
                v-model="deal_router_id" />

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

import {
    TextInputComponent,
    TextareaInputComponent
} from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
        TextareaInputComponent,
    },

    emits: ['submit'],

    data() {
        return {
            start_execution: '',
            end_execution: '',
            assignment_log: '',
            deal_router_id: '',
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
