/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import classNames from 'classnames';

/*
 * Local import
 */
 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const Activity = ({ currentDate, startDate, endDate, teacher, student, id,  observation, actions }) => {

  const onChange = (evt) => {
    const { value } = evt.target;
    actions.changeInputObservation(value);
  };

  const startTime = startDate.split(' ')[1].substr(0, 5);
  const endTime = endDate.split(' ')[1].substr(0, 5);
  const stateActivity = (!teacher || !student);
  return (
    <div id="activity-view">
      <h1 id="date-title">{currentDate.format('dddd D MMMM YYYY')}</h1>
      <h2 id="activity-title">Activité {id} de {startTime} à {endTime}</h2>
      <label id="label-observation" htmlFor="observation">Observation :</label>
      <textarea onChange={onChange} id="observation" placeholder="Votre observation..." value={observation} />
      <button onClick={actions.resetObservation}>Annuler Modification de l'observation</button>
      <p>Vous êtes actuellement
        <span
          className={classNames(
            'activity-state',
            { absent: stateActivity },
            { present: !stateActivity },
          )}
        >
          {teacher ? ' présent ' : ' absent '}
        </span>
        pour ce cours
      </p>
      <p>Le cours est
        <span
          className={classNames(
            'activity-state',
            { absent: stateActivity },
            { present: !stateActivity },
          )}
        >
          {stateActivity ? ' est annulé' : ' n\'est pas annulé'}
        </span>
      </p>


      <Link to="/ProjectMJC/projetMJC/web/app_dev.php" >
        Retour Agenda
      </Link>
    </div>
  );
};

Activity.propTypes = {
  currentDate: PropTypes.object.isRequired,
  startDate: PropTypes.string.isRequired,
  endDate: PropTypes.string.isRequired,
  id: PropTypes.number.isRequired,
  teacher: PropTypes.bool.isRequired,
  student: PropTypes.bool.isRequired,
  observation: PropTypes.string.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Activity;
