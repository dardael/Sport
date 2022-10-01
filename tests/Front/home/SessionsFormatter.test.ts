import Session from "../../../assets/sessions/components/entities/Session";
import SessionsFormatter from "../../../assets/home/components/entities/SessionsFormatter";
import SessionType from "../../../assets/settings/sessions/entities/Session";

describe('getSessionsTypes', () => {
    test('works with no sessions', () => {
        expect(new SessionsFormatter([], []).getSessionsTypes()).toStrictEqual([]);
    });
    test('works with sessions', () => {
        const sessions = [
            new Session(1,3,2, new Date()),
            new Session(1,1,2, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
            new SessionType(3, 'abdo', 'rep', '', ''),
            new SessionType(2, 'squat', 'rep', '', ''),
        ]
        expect(new SessionsFormatter(sessions,sessionsTypes).getSessionsTypes())
            .toStrictEqual([sessionsTypes[1], sessionsTypes[0]]);
    });
    test('returns only one time a sessionType', () => {
        const sessions = [
            new Session(1,1,2, new Date()),
            new Session(1,1,2, new Date()),
            new Session(1,3,2, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
            new SessionType(3, 'abdo', 'rep', '', ''),
            new SessionType(2, 'squat', 'rep', '', ''),
        ]
        expect(new SessionsFormatter(sessions, sessionsTypes).getSessionsTypes())
            .toStrictEqual([sessionsTypes[0], sessionsTypes[1]]);
    });
});
describe('getSessionsOrderedByDate', () => {
    test('works with no sessions', () => {
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
        ];
        expect(new SessionsFormatter([], sessionsTypes).getSessionsOrderedByDate(1))
            .toStrictEqual([]);
    });
    test('works with no sessions of the asked session type', () => {
        const sessions = [
            new Session(1,1,2, new Date()),
            new Session(1,3,2, new Date()),
            new Session(1,0,2, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(4, 'pompe', 'rep', '', ''),
        ];
        expect(new SessionsFormatter(sessions, sessionsTypes).getSessionsOrderedByDate(4))
            .toStrictEqual([]);
    });
    test('works with session of the asked session type', () => {
        const sessions = [
            new Session(1,1,2, new Date(2000,1,1)),
            new Session(1,3,2, new Date()),
            new Session(1,0,2, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
        ];
        expect(new SessionsFormatter(sessions, sessionsTypes).getSessionsOrderedByDate(1))
            .toStrictEqual([{date: new Date(2000,1,1).toLocaleDateString(), Repetition: 2}]);
    });
    test('works with sessions of the asked session type ordered by date', () => {
        const sessions = [
            new Session(1,1,2, new Date(2020,1,1)),
            new Session(1,1,2, new Date(2019,1,1)),
            new Session(1,1,2, new Date(2020,2,1)),
            new Session(1,3,2, new Date()),
            new Session(1,0,2, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
        ];
        expect(new SessionsFormatter(sessions, sessionsTypes).getSessionsOrderedByDate(1)).toStrictEqual(
            [
                {date: new Date(2019,1,1).toLocaleDateString(), Repetition: 2},
                {date: new Date(2020,1,1).toLocaleDateString(), Repetition: 2},
                {date: new Date(2020,2,1).toLocaleDateString(), Repetition: 2},
            ]
        );
    });
});
describe('getSummedSessionsValuesByExercices', () => {
    test('works with no sessions', () => {
        expect(new SessionsFormatter([], []).getSummedSessionsValuesByExercices())
            .toStrictEqual([]);
    });
    test('works with one session', () => {
        const sessions = [
            new Session(1,1,2, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
        ];
        expect(new SessionsFormatter(sessions, sessionsTypes).getSummedSessionsValuesByExercices())
            .toStrictEqual([{
                name: 'pompe',
                Repetition: 2,
            }]);
    });
    test('works with two sessions of the same type', () => {
        const sessions = [
            new Session(1,1,2, new Date()),
            new Session(2,1,4, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
        ];
        expect(new SessionsFormatter(sessions, sessionsTypes).getSummedSessionsValuesByExercices())
            .toStrictEqual([
                {
                    name : 'pompe',
                    Repetition : 6,
                }
            ]);
    });
    test('works with three sessions of the differents types', () => {
        const sessions = [
            new Session(1,1,2, new Date()),
            new Session(2,2,5, new Date()),
            new Session(3,1,4, new Date()),
        ];
        const sessionsTypes = [
            new SessionType(1, 'pompe', 'rep', '', ''),
            new SessionType(2, 'abdo', 'rep', '', ''),
        ];
        expect(new SessionsFormatter(sessions, sessionsTypes).getSummedSessionsValuesByExercices())
            .toStrictEqual([
                {
                    name : 'pompe',
                    Repetition : 6,
                },
                {
                    name : 'abdo',
                    Repetition : 5,
                },
            ]);
    });
});
