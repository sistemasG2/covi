export class Modal {

  /**
  * Create instance of Modal
  * @param {array} options with options
  */
  constructor(arr = []) {

    this.originalArr = arr

    for (let option in arr) {
      this[arr[option]] = false
    }

    this.show = false
    this.text = false
  }

  clearOptions() {
    for (let option in this.originalArr) {
      this[this.originalArr[option]] = false
    }
    this.show = false
    this.text = false
  }

  /**
   *
   * @param {string} options
   * @param {string} text
   */
  open(str, text = '') {
    this.clearOptions()
    this[str] = true
    this.text = text
    this.show = true
  }

  close() {
    this.clearOptions()
  }

}

export class Table {
  /**
   * Create new instance of Table
   *
   * @param array with table headers
   */
  constructor(array) {
    this.headers = array
    this.items = []
    this.isLoading = false
    this.pagination = {}
  }
  /**
   * Load items from given url
   *
   * @param {string} url
   */
  loadData(url) {
    // axios.get(url)
    //   .then(res => {
    //     this.items = res.data
    //   })
    return new Promise((resolve, reject) => {
      axios.get(url)
        .then(response => {
          this.items = response.data
          resolve(response.data)
        })
        .catch(error => {
          reject(error.response.data)
        })
    })
  }
}

export class Searchbox {
  constructor() {
    this.search = ''
    this.items = []
  }

  setItems(items) {
    this.items = items
  }

  filteredItems() {
    if (this.search && this.toggleViewOptions == 0) {
      let items = this.items
      let result = [];

      for (var i = 0; i < items.length; i++) {
        let verified = false
        Object.keys(items[i]).some(prop => {
          let item = items[i][prop]
          if (item) {
            let content = item.toString().toLowerCase()
            if (content.includes(this.search.toLowerCase())) {
              verified = true
            }
          }
        })
        if (verified == true) {
          result.push(items[i])
        }
      }

      return result
    }

    return this.items
  }
}


export class Calendar {
  constructor() {
    this.now = new Date()
    this.month = this.now.getMonth()
    this.year = this.now.getFullYear()
    this.dayTitles = ['D', 'L', 'K', 'M', 'J', 'V', 'S']
  }

  daysCount() {
    let count = new Date(this.year, this.month + 1, 0).getDate()
    return count
  }

  getDates() {
    let prevMonth =
      (this.month > 0) ? prevMonth = new Date(this.year, this.month, 0) : prevMonth = new Date(this.year-1, 12, 0)

    let nextMonth =
      (this.month < 11) ? nextMonth = new Date(this.year, this.month + 2, 0) : nextMonth = new Date(this.year+1, 1, 0)

    let initialDay = new Date(this.year, this.month).getDay()

    let weeksCount = (initialDay == 6 && this.daysCount() >= 30) ? 6 : 5

    let daysToFill = (weeksCount == 5) ? 35 - this.daysCount() : 42 - this.daysCount()

    let daysNext = daysToFill - initialDay
    let daysPrev = daysToFill - daysNext

    let dates = []

    for (let i = daysPrev - 1; i >= 0; i--) {
      let date = {
        class: 'prev_month_dates',
        date: new Date(prevMonth.getFullYear(), prevMonth.getMonth(), prevMonth.getDate() - i)
      }
      dates.push(date)
    }

    for (let i = 0; i < this.daysCount() + daysNext; i++) {
      let date = {
        class: (i > this.daysCount()) ? 'next_month_dates' : '',
        date: new Date(this.year, this.month, i + 1)
      }
      dates.push(date)
    }

    return dates
  }

  getNameOftheMonth() {
    let names = [
      'Enero',
      'Febrero',
      'Marzo',
      'Abril',
      'Mayo',
      'Junio',
      'Julio',
      'Agosto',
      'Septiembre',
      'Octubre',
      'Noviembre',
      'Diciembre',
    ]

    return names[this.month]
  }

  prevMonth() {
    if (this.month > 0) {
      this.month -= 1
    }
    else
    {
      this.month = 11
      this.year -= 1
    }
  }

  nextMonth() {
    if (this.month < 11) {
      this.month += 1
    }
    else
    {
      this.month = 0
      this.year += 1
    }
  }
}
