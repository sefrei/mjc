/*
 * Npm Import
 */
import moment from 'moment';

/*
 * Types
 */
const CHANGE_DATE = 'CHANGE_DATE';
/*
 * initialState
 */
const initialState = {
  currentDate: moment(),
  lecons: [
    //{1, '22/05/2017', duration, speciality, TisPresent, SisPresent},
  ],
};


/*
 * Reducer
 */
export default (state = initialState, action = {}) => {
  switch (action.type) {
    case CHANGE_DATE:
      return {
        ...state,
        currentDate: action.date,
      };
    default:
      return state;
  }
};


/*
 * Action creators
 */
export const changeDate = (date) => {
  console.log(date);
  return (
  {
    type: CHANGE_DATE,
    date,
  }
  );
};
