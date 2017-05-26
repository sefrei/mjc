export default {
  activity: [
    {
      id: 1,
      startDate: '2017-05-23 09:00:00',
      endDate: '2017-05-23 10:00:00',
      duration: '1h',
      speciality: 'guitare',
      studentName: 'Yves',
      teacher: true,
      student: true,
      observation: '',
    },
    {
      id: 2,
      startDate: '2017-05-23 11:00:00',
      endDate: '2017-05-23 12:00:00',
      duration: '1h',
      speciality: 'guitare',
      studentName: 'Séverine',
      teacher: true,
      student: true,
      observation: '',
    },
    {
      id: 3,
      startDate: '2017-05-23 14:00:00',
      endDate: '2017-05-23 15:00:00',
      duration: '1h',
      speciality: 'guitare',
      studentName: 'Julien',
      teacher: true,
      student: false,
      observation: '',
    },
  ],
  notifications: [
    {
      id: 1,
      message: 'Vous avez un nouveau cours',
      etat: true,
    },
    {
      id: 2,
      message: 'Un cours est annulé',
      etat: false,
    },
    {
      id: 3,
      message: 'Vous avez un nouveau cours',
      etat: true,
    },
  ],
};
