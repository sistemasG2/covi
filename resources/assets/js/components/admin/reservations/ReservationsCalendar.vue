<template lang="html">
  <div class="r_calendar layout row wrap">
    <v-flex class="r_calendar__dates flex_center_all" xs12 sm8>
      <div class="r_calendar__dates__heading">
        <v-layout class="flex_center_all grey--text" row>
          <v-btn icon flat @click="calendar.prevMonth()">
            <v-icon class="grey--text">chevron_left</v-icon>
          </v-btn>
          <h1 class="display-1">{{ calendar.getNameOftheMonth() }} {{ calendar.year }}</h1>
          <v-btn icon flat @click="calendar.nextMonth()">
            <v-icon class="grey--text">chevron_right</v-icon>
          </v-btn>
        </v-layout>
        <v-divider class="mt-1 mb-2"></v-divider>
      </div>
      <div class="r_calendar__dates__body">
        <v-layout row>
          <div class="calendar__dates__days_titles" v-for="day in calendar.dayTitles">{{ day }}</div>
        </v-layout>
        <v-layout class="calendar_dates" row wrap>
          <div v-for="date in calendar.getDates()" class="calendar_dates__date" :class="getDateClasses(date)">
            {{ date.date.getDate() }}
          </div>
        </v-layout>
      </div>
    </v-flex>
    <v-flex class="r_calendar__info cyan lighten-3" xs12 sm4>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem perspiciatis illo aspernatur beatae delectus non ipsa maxime eius id consequatur optio aut ab voluptatum, inventore, odit numquam debitis vero similique!
    </v-flex>
  </div>
</template>

<script>
import {Calendar} from '../../../classes.js'
export default {
  data() {
    return {
      calendar: new Calendar(),
      reservations: [
        new Date(2018,0,4),
        new Date(2018,0,8),
        new Date(2018,0,29),
      ]
    }
  },
  methods: {
    getDateClasses(date) {
      let classes = date.class

      console.log(this.reservations.length)

      for (var i = 0; i < this.reservations.length; i++) {
        if (this.reservations[i].getDate() == date.date.getDate()) {
          classes += ' reserved'
        }
      }

      return classes
    }
  },
  beforeMount() {
    console.log(this.reservations)
  }
}
</script>

<style lang="scss">
  .r_calendar
  {
    height: 100%;

    &__dates
    {
      flex-direction: column;

      &__body
      {
        .calendar_dates
        {
          width: 350px;

          &__days_titles
          {
            width: 50px;
            height: 50px;
          }

          &__date
          {
            align-items: center;
            color: #9e9e9e;
            display: flex;
            font-size: 18px;
            height: 50px;
            justify-content: center;
            width: 50px;

            &.reserved
            {
              position: relative;
              &:before {
                border-radius: 50%;
                border: 2px solid lighten(green*2, 30%);
                content: ' ';
                position: absolute;
                top: 50%;
                left: 50%;
                height: 75%;
                width: 75%;
                transform: translate(-50%, -50%);
              }
            }
          }
        }
      }
    }

    &__info
    {

    }
  }

  .flex_center_all
  {
    align-items: center;
    display: flex;
    justify-content: center;
  }
</style>
