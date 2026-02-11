import { Success, Failure, Command, effectPipe, runEffect } from '/js/pure-effect.js';
import '/js/mithril.js';

const baseApiUrl = 'http://localhost:8080';

// Utilities
const makeGetApiCall = async (endpoint) => {
  const apiUrl = `${baseApiUrl}/${endpoint}`;
  try {
    const response = await fetch(apiUrl);
    if (!response.ok) {
      return Failure(response.status);
    }

    const json = await response.json();
    return Success(json);
  } catch (error) {
    return Failure(error.message);
  }
};

// effectPipe wrapping ceremony to handle makeGetApiCall via Command
const getData = (input) => {
  const cmdApiCall = () => makeGetApiCall(input.endpoint);
  const next = (data) => Success(data);
  return Command(cmdApiCall, next);
};

const makePostApiCall = async (endpoint, postData) => {
  const apiUrl = `${baseApiUrl}/${endpoint}`;

  try {
    const response = await fetch(apiUrl, {
      method: 'POST',
      body: JSON.stringify(postData),
    });

    if (!response.ok) {
      return Failure(response.status);
    }

    const json = await response.json();
    return Success(json);
  } catch (error) {
    return Failure(error.message);
  }
};

const postData = ({endpoint, formData}) => {
  const cmdApiCall = () => makePostApiCall(endpoint, formData);
  const next = (responseData) => Success(responseData);
  return Command(cmdApiCall, next);
};


// \Utilities



// Worker api calls and html
const getWorkerListItemHtml = (user) => {
  return `<li>${user.name} | <span>${user.email}</span></li>`;
};

const writeWorkerPageData = (dataWrapper) => {

  const ul = document.querySelector('#workers ul');
  let workerList = '';

  for (let user of dataWrapper.value) {
    workerList += getWorkerListItemHtml(user);
  }

  ul.innerHTML = workerList;

  return Success(dataWrapper.value);
}

const writeWorkerData = (input) => {
  if (input.type !== 'Success') {
    return input;
  }

  const writeDataCall = () => writeWorkerPageData(input);
  const next = (data) => Success(data);

  return Command(writeDataCall, next);
};

const getUserDataFlow = (input) => effectPipe(
    getData,
    writeWorkerData
  )(input);
    
async function loadWorkerData() {
  const logic = getUserDataFlow({endpoint: 'account' });
  const result = await runEffect(logic);

  if (result.type === 'Success') {
    console.log('Success: [loadWorkerData]', result.value);
  } 

  if (result.type !== 'Success') {
    console.error('Error: [loadWorkerData]', result.error);
  }
};

loadWorkerData();


// Shifts api calls and html
const getShiftListItemHtml = ({date, crew_start, required_roles}) => {
  let html = '<li>'
  html += `${date} | <span>${crew_start}</span>`;
  html += `<ul>`;
  html += `<li>lead: ${required_roles.lead}</li>`;
  html += `<li>helper: ${required_roles.helper}</li>`;
  html += `</ul>`;
  html += '</li>';
  return html;
};

const writeShiftPageData = (dataWrapper) => {

  const ul = document.querySelector('#shifts ul');
  let shiftsList = '';

  for (let shift of dataWrapper.value) {
    shiftsList += getShiftListItemHtml(shift);
  }

  ul.innerHTML = shiftsList;

  return Success(dataWrapper.value);
}

const writeShiftData = (input) => {
  if (input.type !== 'Success') {
    return input;
  }

  const writeDataCall = () => writeShiftPageData(input);
  const next = (data) => Success(data);

  return Command(writeDataCall, next);
};



const getShiftDataFlow = (input) => effectPipe(
    getData,
    writeShiftData
  )(input);

async function loadShiftData() {
  const logic = getShiftDataFlow({endpoint: 'shift' });
  const result = await runEffect(logic);

  if (result.type === 'Success') {
    console.log('Success: [loadShiftData]', result.value);
  } 

  if (result.type !== 'Success') {
    console.error('Error: [loadShiftData]', result.error);
  }
}

loadShiftData();


// New Worker
const makeNewWorkerFlow = (input) => effectPipe(
  postData  
)(input);


async function makeNewWorker() {
  const logic = makeNewWorkerFlow({endpoint: 'account', formData: {} });
  const result = await runEffect(logic);

  if (result.type === 'Success') {
    console.log('Success: [makeNewWorker]', result.value);
  } 

  if (result.type !== 'Success') {
    console.error('Error: [makeNewWorker]', result.error);
  }
}

// makeNewWorker();
