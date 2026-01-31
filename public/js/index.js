import { Success, Failure, Command, effectPipe, runEffect } from '/js/pure-effect.js';

const baseApiUrl = 'http://localhost:8080';

const makeApiCall = async (endpoint) => {
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

// effectPipe wrapping ceremony to handle makeApiCall via Command
const getData = (input) => {
  const cmdApiCall = () => makeApiCall(input.endpoint);
  const next = (data) => Success(data);
  return Command(cmdApiCall, next);
};

const writePageData = (dataWrapper) => {

  const ul = document.querySelector('#workers ul');


  return Success(dataWrapper.value);
}

const writeData = (input) => {
  if (input.type !== 'Success') {
    return input;
  }

  const writeDataCall = () => writePageData(input);
  const next = (data) => Success(data);

  return Command(writeDataCall, next);
};

const getUserDataFlow = (input) => effectPipe(
    getData,
    writeData
  // add function for writing data to page
  )(input);
    
async function loadWorkerData() {
  const logic = getUserDataFlow({endpoint: 'account' });
  const result = await runEffect(logic);

  if (result.type === 'Success') {
    console.log('Success:', result.value);
  } 

  if (result.type !== 'Success') {
    console.error('Error:', result.error);
  }
};

loadWorkerData();


