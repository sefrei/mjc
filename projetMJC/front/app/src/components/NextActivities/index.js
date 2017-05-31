/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import moment from 'moment';
import 'moment/locale/fr';
/*
 * Local import
 */

 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const NextActivities = ({ days, actions }) => {
  const onChange = (evt) => {
    const date = moment(evt);
    actions.changeDate(date);
  };
  return (
    <div id="nextActivities">
      <h1>Prochaines journées active :</h1>
      {days.map(day => (
        <p
          key={day.id}
          onClick={() => onChange(day.date)}
        >
          -<span className="dayActivities">{moment(day.date).format('dddd D MMMM YYYY')} : {day.nbActivity} activité{day.nbActivity > 1 ? 's' : ''}</span>
        </p>
      ))}
    </div>
  );
};
NextActivities.propTypes = {
  days: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default NextActivities;
