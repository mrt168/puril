const calendarCells = document.getElementsByClassName("calendar-cell");
const dateCells = document.getElementsByClassName("calendar-date");

let currentChoiceCount = 0;
const currentChoices = [];
const currentChoicesExpression = [];
let currentWeekCount = 0;

function calendarCellTapped(elm) {
  const top = elm.offsetTop;
  const left = elm.offsetLeft;

  function findVector() {
    let j = 0;
    let l = 0;
    for (let i = 0; i < calendarCells.length; i++) {
      const cell = calendarCells[i];
      if (cell.offsetTop === top && cell.offsetLeft === left) {
        return [j, l];
      }
      j++;
      if (j === 7) {
        j = 0;
        l++;
      }
    }
  }

  function convertDateTimeFromVector(vector) {
    const dateCell = dateCells[vector[0]];
    const dates = dateCell.innerText.trim();
    const date = dates.split("\n")[0];
    const dayOfWeek = dates.split("\n")[1];
    const year = dateCell.id.split("/")[0];
    const time = [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21][vector[1]];
    const timeExpression = `${time}:00`;
    return {
      date,
      time,
      year,
      dayOfWeek,
      key: `${vector[0]}${vector[1]}`,
      currentWeekCount
    };
  }

  const result = convertDateTimeFromVector(findVector());

  if (!elm.innerHTML) {
    // maxに達していたら飛ばす
    if (currentChoiceCount === 3) return;
    // タップされていない状態からのタップ
    currentChoiceCount++;
    currentChoices.push(result);
  } else {
    // タップされている状態からのタップ
    currentChoiceCount--;
    let counter = 0;
    for (const choice of currentChoices) {
      if (
        choice.currentWeekCount === result.currentWeekCount &&
        choice.key === result.key
      ) {
        currentChoices.splice(counter, 1);
      }
      counter++;
    }
  }

//   console.log(currentChoices);

  renderCalendarExpressions();
  changeInputConditions();
}

function renderCalendarExpressions() {
  /* calendar変更 */
  function findCell(key) {
    let j = 0;
    let l = 0;
    for (let i = 0; i < calendarCells.length; i++) {
      if (key === `${j}${l}`) {
        const cell = calendarCells[i];
        return cell;
      }
      j++;
      if (j === 7) {
        j = 0;
        l++;
      }
    }
  }
  for (let i = 0; i < calendarCells.length; i++) {
    calendarCells[i].innerHTML = ``;
  }
  let counter = 0;
  for (const choice of currentChoices) {
    counter++;
    if (choice.currentWeekCount !== currentWeekCount) continue;
    findCell(
      choice.key
    ).innerHTML = `<div class="calendar-cell-text">${counter}</div>`;
  }
  /* calendar変更_終了 */
  document.getElementById(
    "calendar-title-number"
  ).innerText = `${currentChoiceCount + 1}`;
  if (currentChoiceCount === 3) {
    document.getElementById("calendar-title-number").innerText = `3`;
  }
  counter = 1;
  for (let i = 1; i <= 3; i++) {
    document.getElementById(`calendar-date-${i}`).innerHTML = `&nbsp;`;
    document.getElementById(`calendar-time-${i}`).innerHTML = `&nbsp;`;
  }
  for (const choice of currentChoices) {
    const dates = choice.date.split("/");
    const month = Number(dates[0]);
    const day = Number(dates[1]);
    const dayOfWeek = choice.dayOfWeek;
    const time = `${choice.time}:00`;
    document.getElementById(
      `calendar-date-${counter}`
    ).innerText = `${month}月${day}日${dayOfWeek}`;
    document.getElementById(`calendar-time-${counter}`).innerText = `${time}`;
    counter++;
  }
}

function changeInputConditions() {}

function next7days() {
  function getDate(dateExpression) {
    var date = new Date(dateExpression);
    date.setDate(date.getDate() + 7);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    return String(year) + "/" + String(month) + "/" + String(day);
  }
  for (let i = 0; i < dateCells.length; i++) {
    const dateCell = dateCells[i];
    const dateExpression = dateCell.id;
    const next = getDate(dateExpression);
    dateCell.setAttribute("id", next);
    dateCell.innerHTML = `${next.split("/")[1]}/${next.split("/")[2]}<br>${
      dateCell.innerHTML.split(`<br>`)[1]
    }`;
  }
  currentWeekCount++;
  renderCalendarExpressions();
  document.getElementById("pre7days").classList.remove("disable");
}

function pre7days() {
  if (currentWeekCount === 0) return;
  function getDate(dateExpression) {
    var date = new Date(dateExpression);
    date.setDate(date.getDate() - 7);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    return String(year) + "/" + String(month) + "/" + String(day);
  }
  for (let i = 0; i < dateCells.length; i++) {
    const dateCell = dateCells[i];
    const dateExpression = dateCell.id;
    const next = getDate(dateExpression);
    dateCell.setAttribute("id", next);
    dateCell.innerHTML = `${next.split("/")[1]}/${next.split("/")[2]}<br>${
      dateCell.innerHTML.split(`<br>`)[1]
    }`;
  }
  currentWeekCount--;
  renderCalendarExpressions();
  if (currentWeekCount === 0) {
    document.getElementById("pre7days").classList.add("disable");
  }
}
