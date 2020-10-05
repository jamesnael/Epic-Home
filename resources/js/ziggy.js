    var Ziggy = {
        namedRoutes: {"tipe-proyek.table":{"uri":"api\/master-data\/tipe-proyek\/table","methods":["GET","HEAD"],"domain":null},"tipe-proyek.data":{"uri":"api\/master-data\/tipe-proyek\/{tipe_proyek}\/data","methods":["GET","HEAD"],"domain":null},"tipe-proyek.store":{"uri":"api\/master-data\/tipe-proyek","methods":["POST"],"domain":null},"tipe-proyek.update":{"uri":"api\/master-data\/tipe-proyek\/{tipe_proyek}","methods":["PUT","PATCH"],"domain":null},"tipe-proyek.destroy":{"uri":"api\/master-data\/tipe-proyek\/{tipe_proyek}","methods":["DELETE"],"domain":null},"tipe-proyek.index":{"uri":"master-data\/tipe-proyek","methods":["GET","HEAD"],"domain":null},"tipe-proyek.create":{"uri":"master-data\/tipe-proyek\/tambah","methods":["GET","HEAD"],"domain":null},"tipe-proyek.edit":{"uri":"master-data\/tipe-proyek\/{tipe_proyek}\/ubah","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://localhost/',
        baseProtocol: 'http',
        baseDomain: 'localhost',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
