<template>
    <div class="panel panel-default">
        <div class="panel-heading">Fatores de Risco</div>
        <div class="panel-body">
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Seu pai ou sua mãe já tiveram AVC?
                </label>
                <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.avc.parents"
                           :options="options['risk_factors.avc_parents']"
                           @select="risk_factors.avc.parents = arguments[0]" 
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Algum outro parente de primeiro grau teve avc?(tio,irmão ou filho)
                </label>
                <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.avc.family"
                           :options="options['risk_factors.avc_family']"
                           @select="risk_factors.avc.family = arguments[0]"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>

            <jv-section title="HAS">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-6">
                        O (a) Sr(a) tem ou já teve hipertensão?
                    </label>
                    <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.hypertension.status"
                               :options="options['risk_factors.has_hypertension']"
                               @select="risk_factors.hypertension.status = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <template v-if="hasHypertension">
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            Há quanto tempo?
                        </label>
                        <jv-months class="col-xs-12 col-sm-6" :value="risk_factors.hypertension.months"
                                   @update="risk_factors.hypertension.months = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-months>
                    </div>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            O(a) Sr(a) faz tratamento com medicamentos?
                        </label>

                        <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.hypertension.medicines"
                                   :options="options['risk_factors.medicines']"
                                   @select="risk_factors.hypertension.medicines = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>

                    <div v-if="risk_factors.hypertension.medicines && !risk_factors.hypertension.medicines.includes('nao')"
                         class="row">
                        <div class="col-xs-12 form-group">
                            <label>Quais medicamentos?</label>
                            <jv-check-group
                                    gid="rf_has_medicines_items"
                                    :value="risk_factors.hypertension.medicines_items"
                                    :options="options['risk_factors.has_medicines_items']"
                                    @update="risk_factors.hypertension.medicines_items = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            Participa do grupo de hipertensão / agente de saúde visita o Sr(a)?
                        </label>
                        <jv-yesno class="col-xs-12 col-sm-6" uid="has_group_visit"
                                  :value="risk_factors.hypertension.group_visit"
                                  @select="risk_factors.hypertension.group_visit = arguments[0]"
                                  :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>
                    </template>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            A última vez que o(a) Sr(a) verificou a P.A estava em quanto?
                        </label>
                        <div class="col-xs-12 col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control" v-mask="'###/###'"
                                       v-model="risk_factors.hypertension.pa"
                                       placeholder="___/___"
                                       :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                                <span class="input-group-addon">mmHg</span>
                            </div>
                        </div>
                    <jv-select class="col-xs-6 col-sm-3" :value="risk_factors.hypertension.pa_answer"
                                   :options="options['risk_factors.diabetes_hemoglobin_hba1c']"
                                   @select="risk_factors.hypertension.pa_answer = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-xs-12">Conclusão</label>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <jv-radio-group gid="risk-factors-has-conclusion" :value="risk_factors.hypertension.conclusion"
                                                @update="risk_factors.hypertension.conclusion = arguments[0]"
                                                :options="options['risk_factors.has_conclusion']"
                                                :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                            </div>
                        </div>
                    </div>

            </jv-section>

            <jv-section title="Diabetes">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-6">
                        O(a) Sr(a) tem diabetes?
                    </label>
                    <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.diabetes.status"
                               :options="options['risk_factors.diabetes']"
                               @select="risk_factors.diabetes.status = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <template v-if="risk_factors.diabetes.status && risk_factors.diabetes.status.includes('sim')">
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            Há quanto tempo?
                        </label>
                        <jv-months class="col-xs-12 col-sm-6" :value="risk_factors.diabetes.months"
                                   @update="risk_factors.diabetes.months = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-months>
                    </div>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            O(a) Sr(a) faz tratamento com medicamentos?
                        </label>

                        <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.diabetes.medicines"
                                   :options="options['risk_factors.medicines']"
                                   @select="risk_factors.diabetes.medicines = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>

                    <div v-if="risk_factors.diabetes.medicines && !risk_factors.diabetes.medicines.includes('nao')"
                         class="row">
                        <div class="col-xs-12 form-group">
                            <label>Quais medicamentos?</label>
                            <jv-check-group
                                    gid="rf_diabetes_medicines_items"
                                    :value="risk_factors.diabetes.medicines_items"
                                    :options="options['risk_factors.diabetes_medicines_items']"
                                    @update="risk_factors.diabetes.medicines_items = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            Participa do grupo de diabéticos?
                        </label>
                        <jv-yesno class="col-xs-12 col-sm-6" uid="diabetes.group_visit"
                                  :value="risk_factors.diabetes.group_visit"
                                  @select="risk_factors.diabetes.group_visit = arguments[0]"
                                  :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            A última vez que o(a) Sr(a) verificou a Hemoglobina Glicada estava em quanto?
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       :value="risk_factors.diabetes.hemoglobin_level"
                                       @input="validateHemoglobinLevel($event.target.value)" maxlength="4"
                                       :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            Nível de Admissão HBA1C
                        </label>
                        <jv-select class="col-xs-6 col-sm-6" :value="risk_factors.diabetes.hemoglobin_hba1c_status"
                                   :options="options['risk_factors.diabetes_hemoglobin_hba1c']"
                                   @select="risk_factors.diabetes.hemoglobin_hba1c_status = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>

                </template>
            </jv-section>

            <jv-section title="Tabagismo">
                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-6">
                        Já fumou em média 1 cigarro (charuto/cachimbo), diariamente pelo menos por 1 ano?
                    </label>
                    <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.smoking.status"
                               :options="options['risk_factors.smoking']"
                               @select="risk_factors.smoking.status = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-6">
                        O(a) Sr(a) esteve casado(a) ou vivendo junto com um(a) fumante?
                    </label>
                    <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.smoking.livedwith"
                               :options="options['risk_factors.smoking']"
                               @select="risk_factors.smoking.livedwith = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
            </jv-section>

            <jv-section title="Alcoolismo">
                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-8">
                        O(a) Sr(a) já bebeu bebidas de álcool pelo menos uma vez por semana?
                    </label>
                    <jv-yesno class="col-xs-12 col-sm-4" uid="rf_alcohol_status" :value="risk_factors.alcohol.status"
                              @select="risk_factors.alcohol.status = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>

                <template v-if="risk_factors.alcohol.status">
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-8">
                            Digite o número de doses
                        </label>
                        <div class="col-xs-12 col-sm-4">
                            <input type="number" class="form-control"
                                   v-model="risk_factors.alcohol.doses" maxlength="3" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <label>Selecione a classificação</label>
                            <jv-radio-group gid="risk-factors-alcohol-rating" :value="risk_factors.alcohol.rating"
                                            @update="risk_factors.alcohol.rating = arguments[0]"
                                            :options="options['risk_factors.alcohol_rating']"
                                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <p>Eventual/social - Critério: mulher &lsaquo; de 14 doses/semana homens &lsaquo; 21 doses/semana</p>
                            <p>Critério de dose: Homem 2 latas ou 1 garrafa de cerveja/dia, uma dose de destilado, 2
                                cálice de vinho. Mulher: 1 lata ou ½ garrafa de cerveja/dia, ½ dose de destilado, 1
                                cálice de vinho ou embriaguez 1 x por semana</p>
                        </div>
                    </div>
                </template>
            </jv-section>

            <jv-section title="Dislipidemia">
                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-6">
                        O(a) Sr(a) faz controle de colesterol e triglicerídeos?
                    </label>
                    <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.dyslipidemia.status"
                               :options="options['risk_factors.dyslipidemia']"
                               @select="risk_factors.dyslipidemia.status = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <template v-if="doDyslipidemiaControl">
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            O(a) Sr(a) faz tratamento com medicamentos?
                        </label>
                        <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.dyslipidemia.medicines"
                                   :options="options['risk_factors.medicines']"
                                   @select="risk_factors.dyslipidemia.medicines = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                    <div v-if="risk_factors.dyslipidemia.medicines && !risk_factors.dyslipidemia.medicines.includes('nao')"
                         class="row form-group">
                        <label class="col-xs-12 col-sm-3">Quais medicamentos?</label>
                        <jv-check-group gid="risk-factors-dyslipidemia-medicines-items" class="col-xs-12 col-sm-9" :create="true"
                                        :value="risk_factors.dyslipidemia.medicines_items"
                                        :options="options['risk_factors.dyslipidemia_medicines_items']"
                                        @update="risk_factors.dyslipidemia.medicines_items = arguments[0]"
                                        :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                                        <!-- Tempo -->
                    </div>
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">Há quanto tempo?</label>
                        <jv-months class="col-xs-12 col-sm-6" :value="risk_factors.dyslipidemia.months"
                            @update="risk_factors.dyslipidemia.months = arguments[0]"></jv-months>
                    </div>
                </template>
                


            </jv-section>

            <jv-section title="Fibrilação Atrial / Cardiopatia">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label>
                            <strong>Cardiopatia</strong> <br>
                            O(a) Sr(a) tem algum problema cardíaco?
                            <br>- Já teve IAM (infarto agudo do miocárdio),
                            <br>- Já fez angioplastia ou colocou ponte safena no coração,
                            <br>- Já teve angina ou colocou medicamento em baixo da língua quando teve dor no peito ao
                            fazer
                            esforço ou quando se incomoda?
                        </label>

                        <jv-select :value="risk_factors.cardiopathy.status"
                                   :options="options['risk_factors.cardiopathy']"
                                   @select="risk_factors.cardiopathy.status = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                </div>

                <template v-if="risk_factors.cardiopathy.status && risk_factors.cardiopathy.status.includes('sim')">

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">Quais?</label>
                        <jv-check-group class="col-xs-8 col-sm-6" gid="rf_cardiopathy_patologies"
                                        :value="risk_factors.cardiopathy.patologies"
                                        :options="options['risk_factors.cardiopathy_patologies']"
                                        @update="risk_factors.cardiopathy.patologies = arguments[0]"
                                        :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                    </div>

                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">Outras patologias</label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" class="form-control" v-model="risk_factors.cardiopathy.custom_patology" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label>Conclusão para FA</label>
                            <jv-select :value="risk_factors.cardiopathy.conclusion"
                                       :options="options['risk_factors.cardiopathy_conclusion']"
                                       @select="risk_factors.cardiopathy.conclusion = arguments[0]"
                                       :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                    </div>

                </template>

                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-4">
                        O(a) Sr(a) faz uso de anticoagulante? (Marcoumar, Marevan e/ou Coumadin).
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="risk_factors.cardiopathy.anticoagulant_usage"
                               :options="options['risk_factors.medicines']"
                               @select="risk_factors.cardiopathy.anticoagulant_usage = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user)"></jv-select>
                    <jv-check-group
                            v-if="risk_factors.cardiopathy.anticoagulant_usage && risk_factors.cardiopathy.anticoagulant_usage.includes('sim')"
                            gid="rf_cardiopathy_anticoagulant_items"
                            class="col-xs-12 col-sm-4" :value="risk_factors.cardiopathy.anticoagulant_items"
                            @update="risk_factors.cardiopathy.anticoagulant_items = arguments[0]"
                            :options="options['risk_factors.cardiopathy_anticoagulant_items']"
                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                </div>
            </jv-section>

            <jv-section title="Antitrombótico">
                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-6">
                        O(a) Sr(a) faz tratamento com medicamentos para prevenir derrame?
                    </label>
                    <jv-select class="col-xs-12 col-sm-6" :value="risk_factors.antitrombotic.medicines"
                               :options="options['risk_factors.medicines']"
                               @select="risk_factors.antitrombotic.medicines = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <div v-if="risk_factors.antitrombotic.medicines && !risk_factors.antitrombotic.medicines.includes('nao')"
                     class="row form-group">
                    <label for="" class="col-xs-12 col-sm-6">Quais medicamentos?</label>
                    <jv-check-group class="col-xs-12 col-sm-3" gid="tf_antitrombotic_medicines_items"
                                    :value="risk_factors.antitrombotic.medicines_items"
                                    :options="options['risk_factors.antitrombotic_medicines_items']"
                                    @update="risk_factors.antitrombotic.medicines_items = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                </div>

                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-8">
                        Insuficiência vascular periférica? <em>(Para de caminhar por dor nas pernas, que melhora com o
                        repouso - não é fraqueza).</em>
                    </label>
                    <jv-yesno class="col-xs-12 col-sm-4" uid="antitrombotic_pvi"
                              :value="risk_factors.antitrombotic.pvi"
                              @select="risk_factors.antitrombotic.pvi = arguments[0]"
                              :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>

                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-8">
                        Já fez revascularização arterial com o médico vascular das pernas? (não é varizes).
                    </label>
                    <jv-yesno class="col-xs-12 col-sm-4" uid="antitrombotic_revascularization"
                              :value="risk_factors.antitrombotic.revascularization"
                              @select="risk_factors.antitrombotic.revascularization = arguments[0]"
                              :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>

            </jv-section>

            <jv-section title="Drogadição">
                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-4">
                        O(a) Sr(a) faz uso de drogas ou já fez? Qual?
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="risk_factors.drugs.usage"
                               :options="options['risk_factors.drugs_usage']"
                               @select="risk_factors.drugs.usage = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    <div class="col-xs-12 col-sm-4">
                        <input class="col-xs-12 col-sm-3 form-control" :disabled="!hasUsedDrugs || (action === 'update' && $verifyAccess(user))"
                               v-model="risk_factors.drugs.description" placeholder="Qual?" maxlength="100">
                    </div>
                </div>

                <template v-if="risk_factors.drugs.usage">
                    <div class="row form-group" v-if="risk_factors.drugs.usage.includes('sim')">
                        <label class="col-xs-12 col-sm-8">
                            Há quanto tempo faz uso?
                        </label>
                        <jv-months class="col-xs-12 col-sm-4" :value="risk_factors.drugs.usage_months"
                                   @update="risk_factors.drugs.usage_months = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-months>
                    </div>

                    <div class="row form-group" v-if="risk_factors.drugs.usage.includes('somente-no-passado')">
                        <label class="col-xs-12 col-sm-8">
                            Há quanto tempo parou de usar?
                        </label>
                        <jv-months class="col-xs-12 col-sm-4" :value="risk_factors.drugs.stopped_months"
                                   @update="risk_factors.drugs.stopped_months = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-months>
                    </div>
                </template>
            </jv-section>

            <jv-section title="Sedentarismo">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        O(a) Sr(a) realiza atividade física?
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="risk_factors.sedentary.status"
                               :options="options['risk_factors.sedentary']"
                               @select="risk_factors.sedentary.status = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <p>
                            <strong>(1) Inativo: </strong> emprego/trabalho/sedentário e/ou sem atividade física
                            voluntária/paga/recreativa.
                            <br><strong>(2) Ativo leve:</strong> aposentado/emprego sedentário com ½ hora de atividade
                            física por dia ou trabalhos sedentários sem trabalho sentado sem atividade física.
                            <br><strong>(3) Ativo moderado:</strong> trabalho sedentário com ½ a 1 hora de atividade
                            física por dia ou trabalho sedentário com ½ hora de atividade física por dia, ou trabalho
                            físico mas sem atividade física voluntária recreativa.
                            <br><strong>(4) Ativo intenso:</strong> trabalho sedentário com 1 hora de atividade física
                            por dia ou trabalho sentado com 1 hora de atividade física por dia ou trabalho físico com 1
                            hora de atividade voluntária recreativa ou trabalho manual pesado.
                        </p>
                    </div>
                </div>
            </jv-section>
        </div>
    </div>
</template>

<script type="application/ecmascript">
  import { mapState } from 'vuex'

  export default {
    computed: {
      ...mapState({
        risk_factors: state => state.followup.risk_factors,
        options: state => state.options,
        user: state => state.user,
        followup: state => state.followup,
        group: state => state.group
      }),

      doDyslipidemiaControl: function () {
        const value = this.risk_factors.dyslipidemia.status

        if(this.risk_factors.dyslipidemia.status == 'risk-factors-dyslipidemia-controla-e-trata'){
            return true;
        }else{
            return false;
        }
      },

      hasUsedDrugs: function () {
        return this.risk_factors.drugs.usage && !this.risk_factors.drugs.usage.includes('nao')
      },

      hasHypertension: function () {
        return this.risk_factors.hypertension.status && this.risk_factors.hypertension.status.includes('sim')
      }
    },

    watch: {
      'risk_factors.drugs_usage': function () {
        if (!this.hasUsedDrugs) {
          this.risk_factors.drugs.description = null
        }
      }
    },

    methods: {
      verifyGroup(){
        if(this.group == "JOINVASC") {
            return true
        }
        if(this.group == this.followup.group) {
            return true
        } else {
            return false
        }
    }, 
      useMedicines (value) {
        return value !== 'nao'
      },

      validatePercentage(value) {
        if (value < 0) {
          return 0
        }

        if (value > 100) {
          return 100
        }

        return value
      },

      validateHBA1CLevel (value) {
        this.risk_factors.diabetes.hemoglobin_hba1c_level = this.validatePercentage(value)
      },

      validateHemoglobinLevel (value) {
        this.risk_factors.diabetes.hemoglobin_level = this.validatePercentage(value)
      }
    }
  }
</script>