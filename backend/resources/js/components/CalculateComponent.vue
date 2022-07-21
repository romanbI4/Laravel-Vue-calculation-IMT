<template>
    <div align="center">
        <h1>
            Расчет ИМТ человека
        </h1>

        <p v-if="errors.length" class="alert-danger">
            <b>
                Пожалуйста исправьте указанные ошибки:
            </b>
        <ul>
            <li v-for="error in errors" class="list-inline">
                {{ error }}
            </li>
        </ul>
        </p>

        <div class="form-group align-content-center">
            <label for="height">Ваш рост</label>
            <input type="number" class="form-control" id="height" placeholder="рост в м" step="0.01"
                   v-model="form.height" @input="calculate()" min=1 max=3 maxlength=3 required>
        </div>

        <div class="form-group align-content-center">
            <label for="weight">Ваш вес</label>
            <input type="number" class="form-control" id="weight" placeholder="вес в кг" step="0.01"
                   v-model="form.weight" @input="calculate()" min=1 max=400 maxlength=3 required>
        </div>

        <div class="panel panel-default" v-if="imt">
            <div class="panel-body">
                <div class="align-content-center">
                    <h3>
                        <p class="alert-primary">
                            Ваш ИМТ: {{ imt }}
                        </p>
                        <p>
                            <i>
                                Интерпретация индекса массы тела
                            </i>
                        </p>
                        <p v-if="imt < 18.5" class="bg-success">
                            Ниже нормального веса
                        </p>
                        <p v-if="imt >= 18.5 && imt < 25" class="bg-success">
                            Нормальный вес
                        </p>
                        <p v-if="imt >= 25 && imt < 30" class="bg-success">
                            Избыточный вес
                        </p>
                        <p v-if="imt >= 30 && imt < 35" class="bg-success">
                            Ожирение I степени
                        </p>
                        <p v-if="imt >= 35 && imt < 40" class="bg-success">
                            Ожирение II степени
                        </p>
                        <p v-if="imt > 40" class="bg-success">
                            Ожирение III степени
                        </p>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            imt: null,
            form: {
                weight: '',
                height: ''
            },
            errors: []
        }
    },
    methods: {
        checkForm() {
            if (!this.form.height) {
                this.errors.push('Укажите рост.');
            } else if (!this.validateNumber(this.form.height)) {
                this.errors.push('Укажите корректный рост. ');
            } else if (this.form.height.length > 3 && parseInt(this.form.height) < 0) {
                this.errors.push('Рост не может быть отрицательным либо 4-х значным числом. ');
            }
            if (!this.form.weight) {
                this.errors.push('Укажите вес.');
            } else if (!this.validateNumber(this.form.weight)) {
                this.errors.push('Укажите корректный вес.');
            } else if (this.form.weight.length > 3 && parseInt(this.form.weight) < 0) {
                this.errors.push('Вес не может быть отрицательным либо 4-х значным числом. ');
            }

            if (!this.errors.length) {
                return true;
            }
        },
        validateNumber: function (text) {
            var filter = /[\+]?([\-]?([0-9]{1,})?[\.]?[0-9]{1,})/;
            return filter.test(text);
        },
        calculate() {
            if (this.checkForm()) {
                axios.post('/calculations', this.form)
                    .then(response => {
                        this.imt = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
    }
}
</script>
