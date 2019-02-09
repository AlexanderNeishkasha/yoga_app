export default {
    namespaced: true,
    state: {
        marks: []
    },
    getters: {
        getMarksFromDate(state) {
            return date => {
                let marks = state.marks.find(marks => marks.date == date);
                if (!marks) {

                    marks = {date, morning: false, evening: false};
                    state.marks.push(marks);
                }
                return marks;
            }
        }
    },
    mutations: {
        updateMarks(state, findMarks) {
            let marks = state.marks.find(marks => marks.date == findMarks.date);
            marks = findMarks;
        }
    },
    actions: {
        updateMarks(store) {

        },
        loadMarks(date) {

        }
    }
};
