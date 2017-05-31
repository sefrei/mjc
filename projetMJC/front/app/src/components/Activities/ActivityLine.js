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
import Presence from 'src/containers/Presence';
 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const ActivityLine = ({ startDate, startHour, finishDate, finishHour, activity_id: id, speciality, presenceStudent, presenceTeacher, student }) => {
  const stateActivity = (!presenceTeacher || !presenceStudent);
  return (
    <div className="activity">
      <Link
        to={`/ProjectMJC/projetMJC/web/app_dev.php/activity/${id}`}
      >
        Activité {id} de {startHour} à {finishHour} :
        Cours de {speciality} avec {student} |
        Statut :
        <span
          className={classNames(
          'activity-state',
          { absent: stateActivity },
          { present: !stateActivity },
        )}
        >
          {stateActivity ? 'Annulé' : 'Pas annulé'}
        </span>
      </Link>
      <Presence teacher={presenceTeacher} id={id} />
    </div>
  );
};

ActivityLine.propTypes = {
  startDate: PropTypes.string.isRequired,
  startHour: PropTypes.string.isRequired,
  finishDate: PropTypes.string.isRequired,
  finishHour: PropTypes.string.isRequired,
  activity_id: PropTypes.number.isRequired,
  speciality: PropTypes.string.isRequired,
  presenceStudent: PropTypes.bool.isRequired,
  presenceTeacher: PropTypes.bool.isRequired,
  student: PropTypes.string.isRequired,
};

/*
 * Export default
 */
export default ActivityLine;
