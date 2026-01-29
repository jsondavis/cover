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
    return json;
  } catch (error) {
    return Failure(error.message);
  }
};

const getData = (input) => {
  const cmdApiCall = () => makeApiCall(input.endpoint);
  const next = (data) => Success(data);
  return Command(cmdApiCall, next);
}

const getUserDataFlow = (input) => effectPipe(
    () =>getData(input)
  )(input);
    
async function loadPageData() {

  const logic = getUserDataFlow({endpoint: 'account' });

  const result = await runEffect(logic);

  if (result.type === 'Success') {
    console.log('Success:', result.value);
  } 

  if (result.type !== 'Success') {
    console.error('Error:', result.error);
  }
}

loadPageData();
