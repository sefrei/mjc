/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
/*
 * Local import
 */
 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const ActivityLine = ({ startDate, endDate, id, speciality, studentName, teacher, student, actions }) => {
  // Récupère l'heure sous le format Heure:Minutes du DateTime
  const startTime = startDate.split(' ')[1].substr(0, 5);
  const endTime = endDate.split(' ')[1].substr(0, 5);
  return (
    <div className="activity">
      <Link
        to={`/ProjectMJC/projetMJC/web/app_dev.php/activity/${id}`}
      >
        Activité {id} de {startTime} à {endTime} :
        Cours de {speciality} avec {studentName} |
        Statut : {(!teacher || !student) ? 'Annulé' : 'Pas annulé'}
      </Link>
      {
        (teacher) ?
          <button onClick={actions.switchPresenceTeacher}>Je serais absent</button>
          :
          <button onClick={actions.switchPresenceTeacher}>Je serais présent</button>
      }
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
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default ActivityLine;
