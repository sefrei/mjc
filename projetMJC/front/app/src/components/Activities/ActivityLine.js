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
const ActivityLine = ({ startDate, endDate, id, speciality, studentName, teacher, student }) => {
  // Récupère l'heure sous le format Heure:Minutes du DateTime
  const startTime = startDate.split(' ')[1].substr(0, 5);
  const endTime = endDate.split(' ')[1].substr(0, 5);
  const stateActivity = (!teacher || !student);
  return (
    <div className="activity">
      <Link
        to={`/ProjectMJC/projetMJC/web/app_dev.php/activity/${id}`}
      >
        Activité {id} de {startTime} à {endTime} :
        Cours de {speciality} avec {studentName} |
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
      <Presence teacher={teacher} id={id} />
    </div>
  );
};

ActivityLine.propTypes = {
  startDate: PropTypes.string.isRequired,
  endDate: PropTypes.string.isRequired,
  id: PropTypes.number.isRequired,
  speciality: PropTypes.string.isRequired,
  studentName: PropTypes.string.isRequired,
  teacher: PropTypes.bool.isRequired,
  student: PropTypes.bool.isRequired,
};

/*
 * Export default
 */
export default ActivityLine;
